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
                        <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $post->user->name }} <span
                                class="text-gray-600 dark:text-gray-500">·</span> {{ $post->created_at->format('d M') }}
                            <span class="text-gray-600 dark:text-gray-500">·</span> {{ $post->responses()->count() }}
                            {{ $post->responses()->count() === 1 ? 'response' : 'responses' }}
                        </p>
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
                    <p class="text-gray-500 sm:text-md dark:text-gray-400 mt-2">Hightlight your code by placing it
                        inside ``````.
                        Example: ```console.log("Hello CodeBuddies")```</p>
                </form>
                <div id="post-reply-results">
                    @include('layouts.replies')
                    <div class="mt-4 pb-4">
                        {{ $responses->links() }}
                    </div>
                </div>
            </div>
    </section>
</x-main_layout>
