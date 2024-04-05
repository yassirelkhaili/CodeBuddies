<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function show(int $id): View
    {
        $user = $this->userRepository->getById($id);
        $settings = $user->settings;
        return view('user.settings', compact('user', 'settings'));
    } 
}