<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-24">
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="max-w-screen-md mb-4 lg:mb-8">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Welcome to {{$forum->name}}</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">{{$forum->description}}</p>
            </div>
            <button type="button"
            class="flex justify-center items-center gap-1 open-create-thread-button text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-700 mb-2"><svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
            width="10px" height="10px" viewBox="0 0 45.402 45.402"
            xml:space="preserve">
       <g>
           <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141
               c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27
               c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435
               c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
       </g>
       </svg>Create thread</button>
            <x-search-thread />
            <div class="pb-2 mx-auto max-w-screen-xl sm:pb-6" id="filter-results-threads">
            @include("layouts.threads")
            </div>
        </div>
      </section>
</x-main_layout>