<x-main_layout>
    <section class="bg-gray-50 dark:bg-gray-900 pt-8 mb-16">
        <div class="flex flex-col items-center justify-center px-6 mx-auto mt-20">
            <a href={{ route('home.index') }}
                class="flex gap-3 items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src={{ asset('assets/svgs/brandLogo.svg') }} class="h-8" alt="CodeBuddies Logo">
                CodeBuddies
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-2 md:space-y-4 sm:p-8 flex justify-center items-start flex-col">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Verify your email address
                    </h1>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>                
                    @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                    @endsession
                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-700" role="alert">
                            <span class="font-medium">Form Submission Errors:</span>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Didn't receive the email yet? <a href={{route('verification.notice')}}
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">click to re-send</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-main_layout>
