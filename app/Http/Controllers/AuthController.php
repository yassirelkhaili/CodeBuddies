<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AvatarService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UserRepositoryInterface;

class AuthController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexLoginPage(): View
    {
        return view('auth.login');
    }

    public function indexRegisterPage(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:20|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();

        $user = $this->userRepository->create([
            'name' => $validatedData['username'],
            'email' => $validatedData['email'],
            'avatar' => AvatarService::generateAndDownloadAvatar($validatedData['username']) ?? "",
            'password' => Hash::make($validatedData['password']),
        ]);

        auth()->login($user);

        return redirect()->route('home.index')->with('success', 'Account created succesfully');
    }

    public function login(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (auth()->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('home.index')->with('success', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.index')->with('status', 'You have been logged out successfully.');
    }

    public function indexForgetPasswordForm()
    {
        return view('auth.forget');
    }

    public function indexResetPasswordForm(String $token)
    {
        return view('auth.reset', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
