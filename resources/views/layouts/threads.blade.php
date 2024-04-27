<div class="space-y-8 grid grid-cols-1 md:gap-12 md:space-y-0">
    @forelse ($threads as $thread)
    <div class="hover:bg-gray-200 dark:hover:bg-gray-800 rounded-md hover:cursor-pointer relative">
        <a href="{{ route('threads.show', $thread->id) }}">
            <div class="p-5">
                <div class="flex flex-row justify-between items-center mb-2">
                    <div class="flex justify-center items-center gap-2 text-blue-700 dark:text-blue-500 flex-wrap">
                        <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $thread->user->name }}
                            <span class="text-gray-600 dark:text-gray-500">·</span>
                            {{ $thread->created_at->format('d M') }}
                            <span class="text-gray-600 dark:text-gray-500">·</span>
                            {{ $thread->created_at->diffForHumans() }}
                        </p>
                        <span class="text-gray-600 dark:text-gray-500">·</span>
                        <svg rpl="" aria-hidden="true" class="icon-comment" fill="currentColor"
                            class="text-blue-700 dark:text-blue-500" height="20" icon-name="comment-outline"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.725 19.872a.718.718 0 0 1-.607-.328.725.725 0 0 1-.118-.397V16H3.625A2.63 2.63 0 0 1 1 13.375v-9.75A2.629 2.629 0 0 1 3.625 1h12.75A2.63 2.63 0 0 1 19 3.625v9.75A2.63 2.63 0 0 1 16.375 16h-4.161l-4 3.681a.725.725 0 0 1-.489.191ZM3.625 2.25A1.377 1.377 0 0 0 2.25 3.625v9.75a1.377 1.377 0 0 0 1.375 1.375h4a.625.625 0 0 1 .625.625v2.575l3.3-3.035a.628.628 0 0 1 .424-.165h4.4a1.377 1.377 0 0 0 1.375-1.375v-9.75a1.377 1.377 0 0 0-1.374-1.375H3.625Z">
                            </path>
                        </svg>
                        <span class="text-lg font-semibold">{{ $thread->posts->count() }}
                            {{ $thread->posts->count() === 1 ? 'post' : 'posts' }}</span>
                        <span class="text-gray-600 dark:text-gray-500">·</span>
                        <span class="text-lg font-semibold" id="vote-count">
                            <i class="fa-regular fa-comments"></i>
                            {{ $thread->posts->flatMap->responses->count() }}
                            {{ $thread->posts->flatMap->responses->count() === 1 ? 'response' : 'responses' }}</span>
                        </div>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">{{ $thread->name }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-ellipsis mb-2">{{ $thread->description }}</p>
                <div class="flex gap-2 justify-start items-center flex-row">
                    @forelse ($thread->posts->unique('user_id') as $posts)
                        @if ($loop->index < 10)
                            <img alt="laravel-logo" loading="lazy" width="25" height="25" class="rounded-sm"
                                decoding="async" data-nimg="1" style="color:transparent"
                                src="{{ asset('storage/' . $posts->user->avatar) }}">
                        @endif
                    @empty
                        <p class="text-gray-600 dark:text-gray-500">Be the first to answer this thread!</p>
                    @endforelse
                    @if ($thread->posts->unique('user_id')->count() > 10)
                        <p class="text-gray-600 dark:text-gray-500">And many more have responded...</p>
                    @endif
                </div>
            </div>
        </a>
        @if (auth()->check() && auth()->user()->id === $thread->user->id)
            <div class="absolute bottom-6 right-6 text-gray-600 dark:text-gray-500">
                <svg class="dropdown-toggle-button"
                data-thread-id={{$thread->id}}
                    id="dropdownDefaultButton{{ $thread->id }}" fill="currentColor" height="16"
                    icon-name="overflow-horizontal-fill" viewBox="0 0 20 20" width="16"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z">
                    </path>
                </svg>
                <div id="dropdown{{ $thread->id }}"
                    class="z-10 absolute right-0 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownDefaultButton{{ $thread->id }}">
                        <li>
                            <button type="button" data-thread-id={{ $thread->id }}
                                class="edit-thread-model-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Edit
                                thread</button>
                        </li>
                        <li>
                            <button type="button" data-thread-id={{ $thread->id }}
                                class="delete-thread-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Delete
                                thread</button>
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
            <h3 class="mb-2 text-xl font-bold dark:text-white">Oups no threads were found</h3>
            <p class="text-gray-500 dark:text-gray-400">If you encounter this message then a mistake must have occured,
                please refresh the page and try again</p>
        </div>
    @endforelse
</div>
<div class="mt-4">
    {{ $threads->links() }}
</div>