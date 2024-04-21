<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-24">
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="flex flex-row justify-between items-center">
                <div class="max-w-screen-md mb-4 lg:mb-8">
                    <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">{{ $post->title }}
                    </h2>
                    <div class="flex flex-row gap-2 items-center mb-4">
                        <img id="avatarButton" type="button" data-dropdown-placement="bottom-start"
                            class="aspect-square h-7 rounded cursor-pointer"
                            src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}'s Avatar">
                        <div class="flex flex-row gap-1 text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $post->user->name }} <span
                                class="text-gray-600 dark:text-gray-500">·</span> {{ $post->created_at->format('d M') }}
                            <span class="text-gray-600 dark:text-gray-500">·</span> <span id="response-count">
                                {{ $post->responses()->count() }}
                            {{ $post->responses()->count() === 1 ? 'response' : 'responses' }}
                            </span>
                            <span
                                class="text-gray-600 dark:text-gray-500">·</span><span class="flex justify-center items-center gap-1"> 
                                    <svg rpl="" fill="currentColor" class="cursor-pointer upvote-post-button" data-post-id="{{$post->id}}" height="20" icon-name="downvote-outline" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"> <!--?lit$461203476$--><!--?lit$461203476$--><path d="M10 20a1.122 1.122 0 0 1-.834-.372l-7.872-8.581A1.251 1.251 0 0 1 1.118 9.7 1.114 1.114 0 0 1 2.123 9H6V2.123A1.125 1.125 0 0 1 7.123 1h5.754A1.125 1.125 0 0 1 14 2.123V9h3.874a1.114 1.114 0 0 1 1.007.7 1.25 1.25 0 0 1-.171 1.345l-7.876 8.589A1.128 1.128 0 0 1 10 20Zm-7.684-9.75L10 18.69l7.741-8.44H12.75v-8h-5.5v8H2.316Zm15.469-.05c-.01 0-.014.007-.012.013l.012-.013Z"></path><!--?--> </svg>
                                    <svg rpl="" fill="currentColor" class="cursor-pointer downvote-post-button" data-post-id="{{$post->id}} height="20" icon-name="upvote-outline" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"> <!--?lit$461203476$--><!--?lit$461203476$--><path d="M12.877 19H7.123A1.125 1.125 0 0 1 6 17.877V11H2.126a1.114 1.114 0 0 1-1.007-.7 1.249 1.249 0 0 1 .171-1.343L9.166.368a1.128 1.128 0 0 1 1.668.004l7.872 8.581a1.25 1.25 0 0 1 .176 1.348 1.113 1.113 0 0 1-1.005.7H14v6.877A1.125 1.125 0 0 1 12.877 19ZM7.25 17.75h5.5v-8h4.934L10 1.31 2.258 9.75H7.25v8ZM2.227 9.784l-.012.016c.01-.006.014-.01.012-.016Z"></path><!--?--> </svg>
                                    <span id="vote-count">{{$post->votes}} {{($post->votes === 1 || $post->votes === -1) ? "vote" : "votes"}}</span>
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-500 sm:text-xl dark:text-gray-400">{{ $post->content }}</p>
                </div>
            </div>
            <div class="space-y-8 grid grid-cols-1 md:gap-5 md:space-y-0">
                @session('status')
                    <div class="p-4 mb-4 text-sm text-green-500 rounded-lg bg-red-50 dark:bg-gray-700" role="alert">
                        <span class="font-medium">Status:</span> {{ $value }}
                    </div>
                @endsession
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-600 rounded-lg bg-red-50 dark:bg-gray-700" role="alert">
                        <span class="font-medium">Reply Submission Errors:</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="create-reply-form" method="POST">
                    <div
                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="px-4 py-3 bg-white rounded-lg dark:bg-gray-800">
                            <label for="editor" class="sr-only">Publish reply</label>
                            <textarea id="reply-editor" rows="8"
                                class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="Write a reply..." required></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Post Reply
                    </button>
                    <p class="text-gray-500 sm:text-md dark:text-gray-400 mt-2">Hightlight your code like so: ```{supportedLanguage} {code}```.
                        Example: ```javascript console.log("Hello CodeBuddies")```. See list of <a href="https://github.com/highlightjs/highlight.js/blob/main/SUPPORTED_LANGUAGES.md" class="underline" target="__blank">supported languages.</a></p>
                </form>
                <div id="post-reply-results">
                    @include('layouts.replies')
                    <div class="mt-4 pb-4">
                        {{ $responses->links() }}
                    </div>
                </div>
            </div>
    </section>
    <x-modal name="confirm-reply-edit" maxWidth="xl">
        <form method="post" class="p-6 hidden edit-element-form">
            @csrf
            @method('put')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to edit this reply?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this reply is edited, all of its resources and data will be permanently changed.') }}
            </p>

            <div
            class="mt-2 w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-3 bg-white rounded-lg dark:bg-gray-800">
                <label for="editor" class="sr-only">Edit reply</label>
                <textarea id="reply-editor" rows="8"
                    class="reply-textarea block w-full px-0 text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                    placeholder="Edit the reply..." required></textarea>
            </div>
        </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button class="cancel-edit-modal-element">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-warning-button class="ms-3">
                    {{ __('Edit Reply') }}
                </x-warning-button>
            </div>
        </form>
    </x-modal>
    <x-modal name="confirm-reply-delete" maxWidth="md">
        <form method="post" class="p-6 hidden delete-element-form">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this reply?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this reply is deleted, all of its resources and data will be permanently deleted.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button class="cancel-delete-modal-element">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Delete Reply') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-main_layout>
