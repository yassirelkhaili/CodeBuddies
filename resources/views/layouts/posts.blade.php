<div class="space-y-2 grid grid-cols-1 md:gap-3 md:space-y-0">
    @forelse ($posts as $post)
        <div class="hover:bg-gray-200 dark:hover:bg-gray-800 rounded-md hover:cursor-pointer relative">
            <a href="{{ route('posts.show', $post->id) }}">
                <div class="p-5">
                    <div class="flex flex-row justify-between items-center mb-2">
                        <div class="flex justify-center items-center gap-2 text-blue-700 dark:text-blue-500 flex-wrap">
                            <img alt="laravel-logo" loading="lazy" width="25" height="25" class="rounded-sm"
                                decoding="async" data-nimg="1" style="color:transparent"
                                src="{{ asset('storage/' . $post->user->avatar) }}">
                            <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $post->user->name }}
                                <span class="text-gray-600 dark:text-gray-500">·</span>
                                {{ $post->created_at->format('d M') }}
                                <span class="text-gray-600 dark:text-gray-500">·</span>
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                            <span class="text-gray-600 dark:text-gray-500">·</span>
                            <svg rpl="" aria-hidden="true" class="icon-comment" fill="currentColor"
                                class="text-blue-700 dark:text-blue-500" height="20" icon-name="comment-outline"
                                viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.725 19.872a.718.718 0 0 1-.607-.328.725.725 0 0 1-.118-.397V16H3.625A2.63 2.63 0 0 1 1 13.375v-9.75A2.629 2.629 0 0 1 3.625 1h12.75A2.63 2.63 0 0 1 19 3.625v9.75A2.63 2.63 0 0 1 16.375 16h-4.161l-4 3.681a.725.725 0 0 1-.489.191ZM3.625 2.25A1.377 1.377 0 0 0 2.25 3.625v9.75a1.377 1.377 0 0 0 1.375 1.375h4a.625.625 0 0 1 .625.625v2.575l3.3-3.035a.628.628 0 0 1 .424-.165h4.4a1.377 1.377 0 0 0 1.375-1.375v-9.75a1.377 1.377 0 0 0-1.374-1.375H3.625Z">
                                </path>
                            </svg>
                            <span class="text-lg font-semibold">{{ $post->responses->count() }}
                                {{ $post->responses->count() === 1 ? 'response' : 'responses' }}</span>
                            <span class="text-gray-600 dark:text-gray-500">·</span>
                            <span class="text-lg font-semibold" id="vote-count">{{ $post->votes }}
                                {{ $post->votes === 1 || $post->votes === -1 ? 'vote' : 'votes' }}</span>
                        </div>
                        @if ($post->responses->where('answer', 1)->isNotEmpty())
                            <div class="flex justify- gap-1 items-center text-green-700 dark:text-green-500">
                                <svg fill="currentColor" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="25px" height="25px" viewBox="0 0 305.002 305.002" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M152.502,0.001C68.412,0.001,0,68.412,0,152.501s68.412,152.5,152.502,152.5c84.089,0,152.5-68.411,152.5-152.5
    S236.591,0.001,152.502,0.001z M152.502,280.001C82.197,280.001,25,222.806,25,152.501c0-70.304,57.197-127.5,127.502-127.5
    c70.304,0,127.5,57.196,127.5,127.5C280.002,222.806,222.806,280.001,152.502,280.001z" />
                                            <path d="M218.473,93.97l-90.546,90.547l-41.398-41.398c-4.882-4.881-12.796-4.881-17.678,0c-4.881,4.882-4.881,12.796,0,17.678
    l50.237,50.237c2.441,2.44,5.64,3.661,8.839,3.661c3.199,0,6.398-1.221,8.839-3.661l99.385-99.385
    c4.881-4.882,4.881-12.796,0-17.678C231.269,89.089,223.354,89.089,218.473,93.97z" />
                                        </g>
                                    </g>
                                </svg>
                                <div class="text-lg font-semibold flex gap-2"><span>Answred by</span>
                                    <div class="flex justify-center items-center gap-2"> <img alt="laravel-logo"
                                            loading="lazy" width="25" height="25" class="rounded-sm"
                                            decoding="async" data-nimg="1" style="color:transparent"
                                            src="{{ asset('storage/' . $post->responses->where('answer', 1)->first()->user->avatar) }}"><span
                                            class="text-blue-700 dark:text-blue-500">{{ $post->responses->where('answer', 1)->first()->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">{{ $post->title }}</h3>
                    <div class="flex gap-2 justify-start items-center flex-row">
                        @forelse ($post->responses->unique('user_id') as $response)
                            @if ($loop->index < 10)
                                <img alt="laravel-logo" loading="lazy" width="25" height="25" class="rounded-sm"
                                    decoding="async" data-nimg="1" style="color:transparent"
                                    src="{{ asset('storage/' . $response->user->avatar) }}">
                            @endif
                        @empty
                            <p class="text-gray-600 dark:text-gray-500">Be the first to answer this post!</p>
                        @endforelse
                        @if ($post->responses->unique('user_id')->count() > 10)
                            <p class="text-gray-600 dark:text-gray-500">And many more have responded...</p>
                        @endif
                    </div>
                </div>
            </a>
            @if (auth()->check() && auth()->user()->id === $post->user->id)
                <div class="absolute bottom-6 right-6 text-gray-600 dark:text-gray-500">
                    <svg data-dropdown-toggle="dropdown{{ $post->id }}"
                        id="dropdownDefaultButton{{ $post->id }}" fill="currentColor" height="16"
                        icon-name="overflow-horizontal-fill" viewBox="0 0 20 20" width="16"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 10a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z">
                        </path>
                    </svg>
                    <div id="dropdown{{ $post->id }}"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton{{ $post->id }}">
                            <li>
                                <button type="button" data-post-id={{ $post->id }}
                                    class="edit-post-model-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Edit
                                    post</button>
                            </li>
                            <li>
                                <button type="button" data-post-id={{ $post->id }}
                                    class="delete-post-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Delete
                                    Post</button>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    @empty
        <div>
            <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                <img alt="404-logo" class="w-10 h-10" loading="lazy" decoding="async" data-nimg="1"
                    src={{ asset('./assets/svgs/404-error.svg') }}>
            </div>
            <h3 class="mb-2 text-xl font-bold dark:text-white">Oups no posts were found</h3>
            <p class="text-gray-500 dark:text-gray-400">Be the first to create a post on this thread</p>
        </div>
    @endforelse
</div>
<div class="mt-4">
    {{ $posts->links() }}
</div>
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
                    class="reply-textarea block w-full px-0 text-gray-800  bg-white border-0 dark:bg-gray-800 focus:ring-0  dark:placeholder-gray-400"
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
