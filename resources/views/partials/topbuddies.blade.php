<section class="bg-white dark:bg-gray-900">
    <div class="px-0 mx-auto max-w-screen-xl lg:px-2">
        <div class="grid px-4 pb-8 lg:gap-8 xl:gap-0 lg:pb-16 lg:grid-cols-12 lg:mt-0">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Distinguished
                    CodeBuddies
                </h2>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">We
                    celebrate the contributions of standout members who go above and beyond in sharing knowledge,
                    solving
                    challenges, and fostering a supportive learning environment within our community.</p>
                <a href={{ route('forums.index') }}
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Checkout the forums
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5,12h-4a.5.5,0,0,0-.5.5V20H7V12.5A.5.5,0,0,0,6.5,12Z" />
                        <path d="M14,4H10a.5.5,0,0,0-.5.5V20h5V4.5A.5.5,0,0,0,14,4Z" />
                        <path d="M21.5,8h-4a.5.5,0,0,0-.5.5V20h5V8.5A.5.5,0,0,0,21.5,8Z" />
                    </svg>
                </a>
            </div>
            <div class="lg:mt-0 lg:col-span-5 flex">
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96 mt-8 lg:mt-0">
                        @php
                            use App\Models\User;
                            $users = User::withCount('responses')->orderBy('responses_count', 'desc')->get(5);
                        @endphp
                        @foreach ($users as $user)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="topuser-avatar">
                        </div>
                        @endforeach
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @foreach ($users as $index => $user)
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $index + 1 }}"
                            data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
