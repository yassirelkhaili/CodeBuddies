<x-main_layout>
    <section class="bg-gray-50 dark:bg-gray-900 pt-8">
        <div class="flex flex-col items-center justify-center px-6 mx-auto md:h-screen">
            <a href={{ route('home.index') }}
                class="flex gap-3 items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img src={{ asset('assets/svgs/brandLogo.svg') }} class="h-8" alt="CodeBuddies Logo">
                CodeBuddies
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Forget password
                    </h1>
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
                    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" id="login-form"
                        data-parsley-validate="" method="POST">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" autocomplete="off"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@example.com" required="" data-parsley-required="true"
                                data-parsley-type="email" data-parsley-trigger="change"
                                data-parsley-error-message="Please enter a valid email.">
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send password link</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-main_layout>
