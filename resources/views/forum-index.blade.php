<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-24">
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="max-w-screen-md mb-4 lg:mb-8">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Welcome to {{$forum->name}}</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Below you will find all the different threads related to {{$forum->name}}. Click one and join the conversation</p>
            </div>
            <x-search-thread />
            <div class="pb-2 mx-auto max-w-screen-xl sm:pb-6" id="filter-results-threads">
            @include("layouts.threads")
            </div>
        </div>
      </section>
</x-main_layout>