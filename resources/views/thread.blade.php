<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-24">
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="max-w-screen-md mb-2 lg:mb-4">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Welcome to
                    {{ $thread->name }}</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Below you will find all the different posts
                    related to {{ $thread->name }}</p>
            </div>
            <button type="button"
            class="flex justify-center items-center gap-1 open-create-post-button text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-700 mb-2"><svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
            width="10px" height="10px" viewBox="0 0 45.402 45.402"
            xml:space="preserve">
       <g>
           <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141
               c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27
               c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435
               c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
       </g>
       </svg>Create post</button>
            <x-search-post />
            <div class="pb-2 mx-auto max-w-screen-xl sm:pb-6" id="filter-results-posts">
                @include('layouts.posts')
            </div>
        </div>
    </section>
    <x-modal name="confirm-post-create" maxWidth="xl">
        <form method="post" class="p-6 hidden create-post-form" data-thread-id="{{ $thread->id }}">
            @csrf
    
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Fill up the fields below to create a post') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this post is added, you can access it below and click to see its progress.') }}
            </p>
    
            <div class="mt-1">
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="title" name="title" type="text"
                    class="mt-1 block w-full bg-gray-50 dark:bg-gray-800" required autofocus autocomplete="title"
                    placeholder="enter post title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div
                class="mt-2 w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-3 bg-white rounded-lg dark:bg-gray-800">
                    <label for="editor" class="sr-only">Edit reply</label>
                    <textarea id="reply-editor" rows="8" name="content"
                        class="reply-textarea block w-full px-0 text-gray-300  bg-white border-0 dark:bg-gray-800 focus:ring-0  dark:placeholder-gray-400"
                        placeholder="enter post content..." required></textarea>
                </div>
            </div>
    
            <div class="mt-6 flex justify-end">
                <x-secondary-button class="cancel-post-modal-element">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <x-primary-button class="ms-3">
                    {{ __('Create Post') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
    <x-modal name="confirm-post-edit" maxWidth="xl">
        <form method="post" class="p-6 hidden edit-post-form" data-thread-id="{{ $thread->id }}">
            @csrf
    
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Fill up the fields below to edit a post') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this post is edited, its information will be permanently altered.') }}
            </p>
    
            <div class="mt-1">
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="title" name="title" type="text"
                    class="mt-1 block w-full bg-gray-50 dark:bg-gray-800" required autofocus autocomplete="title"
                    placeholder="enter post title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div
                class="mt-2 w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="px-4 py-3 bg-white rounded-lg dark:bg-gray-800">
                    <label for="editor" class="sr-only">Edit reply</label>
                    <textarea id="reply-editor" rows="8" name="content"
                        class="reply-textarea block w-full px-0 text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="enter post content..." required></textarea>
                </div>
            </div>
    
            <div class="mt-6 flex justify-end">
                <x-secondary-button class="cancel-edit-post-modal-element">
                    {{ __('Cancel') }}
                </x-secondary-button>
    
                <x-warning-button class="ms-3">
                    {{ __('Edit Post') }}
                </x-warning-button>
            </div>
        </form>
    </x-modal>    
</x-main_layout>
