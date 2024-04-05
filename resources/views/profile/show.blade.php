<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js', 'node_modules/flowbite/dist/flowbite.min.js', 'resources/js/script.js'])
        <script src="{{ asset('assets/js/theme.js') }}"></script>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 flex gap-2 justify-center items-center">
                    <x-theme-switcher/>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="mt-16 flex flex-col gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="min-w-[30rem] scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="flex flex-col gap-2 justify-center items-start w-full">
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img class="rounded-full h-16 w-16" src="{{asset('storage/events/' . $event->event_picture)}}" alt="event Logo">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$event->title}}</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    {{$event->description}}
                                </p>
                                <div class="flex justify-between w-full items-center pt-1 w-full">
                                    <div><p class="bg-purple-200 text-purple-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-purple-600 dark:text-purple-300">
                                        {{$event->category->category_name}}
                                    </p></div>
                                    <div class="flex justify-center items-center gap-1">
                                        <p class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{$event->date}}</p>
                                    </div>
                                    <p class="bg-green-200 text-green-800 dark:bg-green-600 dark:text-green-300 text-xs font-medium px-2 py-0.5 rounded">
                                    {{ $event->address}}
                                    </p>
                                </div>
                                <div class="flex flex-col gap-1 justify-center items-start pt-1">
                                    <p class="text-grey-500 dark:text-white">Available seats: </p>
                                    <div class="flex gap-2 flex-wrap justify-center items-center">
                                    <div class="flex flex-row gap-1">
                                        <p class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ $event->available_seats }}</p>
                                    </div>
                                    </div>
                                    <div class="flex flex-col gap-1 justify-center items-start pt-1">
                                        <p class="text-grey-500 dark:text-white">Capacity: </p>
                                        <div class="flex gap-2 flex-wrap justify-center items-center">
                                        <div class="flex flex-row gap-1">
                                            <p class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">{{ $event->capacity }}</p>
                                        </div>
                                        </div>
                                </div>
                                <div class="pt-2 flex flex-col gap-2 justify-center items-start">
                                    <form action="{{ route("ticket.store") }}" method="post">
                                        @csrf
                                        <input type="hidden" name="bookingId" value={{ $event->id }}>
                                        <button type="submit" id="createProductModalButton" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                           Book event now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
