<div>
    <h2 class="text-lg tracking-tight font-semibold text-gray-900 dark:text-white mb-5">Responses:</h2>
    @forelse ($responses as $response)
        @php
            $existingVote = null;
            if (auth()->check()) {
                $existingVote = $response
                    ->votes()
                    ->where('user_id', auth()->id())
                    ->where('votable_type', get_class($response))
                    ->first();
            }
        @endphp
        <div @class([
            'mb-5',
            'pt-4 pb-3 border-green-700 dark:border-green-500 border-b-2 border-t-2' =>
                $response->answer === 1,
        ])>
            <div class="flex flex-row gap-2 items-center justify-between mb-4">
                <div class="flex justify-center items-center gap-2">
                    <img id="avatarButton" type="button" data-dropdown-placement="bottom-start"
                        class="aspect-square h-7 rounded cursor-pointer"
                        src="{{ asset('storage/' . $response->user->avatar) }}"
                        alt="{{ $response->user->name }}'s Avatar">
                    <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $response->user->name }} <span
                            class="text-gray-600 dark:text-gray-500">·</span> {{ $response->created_at->format('d M') }}
                    </p>
                </div>
                @if (auth()->check() &&
                        auth()->user()->id === $response->post->user_id &&
                        $response->answer === 0 &&
                        !\App\Repositories\ResponseRepository::isAnswerMarked($response->post->id))
                    <button type="button" class="text-green-700 dark:text-green-500 underline mark-element-button"
                        data-reply-id={{ $response->id }}>Mark as answer</button>
                @endif
                @if ($response->answer === 1)
                    <div>
                        <span type="button" class="text-green-700 dark:text-green-500 mark-element-button"
                            data-reply-id={{ $response->id }}>Answer</span>
                        @if (auth()->check() && auth()->user()->id === $response->post->user_id)
                            <span class="text-gray-600 dark:text-gray-500">·</span>
                            <span type="button"
                                class="text-red-700 dark:text-red-500 cursor-pointer underline unmark-element-button"
                                data-reply-id={{ $response->id }}>Unmark answer</span>
                        @endif
                    </div>
                @endif
            </div>
            <p class="text-gray-500 sm:text-lg dark:text-gray-400">
                {!! \App\Services\CodeHighlightService::formatResponseContent($response->content) !!}
            </p>
            <div class="mt-1 flex flex-row gap-[0.5rem]">
                @if (auth()->check())
                    @php
                        $upvoteClass =
                            $existingVote && $existingVote->vote_type === 'up'
                                ? 'text-purple-700 dark:text-purple-500'
                                : '';
                        $downvoteClass =
                            $existingVote && $existingVote->vote_type === 'down'
                                ? 'text-purple-700 dark:text-purple-500'
                                : '';
                    @endphp
                    <span class="flex justify-center items-center gap-1 text-blue-700 dark:text-blue-500">
                        <svg rpl="" fill="currentColor" class="cursor-pointer upvote-button {{ $upvoteClass }}"
                            data-reply-id="{{ $response->id }}" height="20" icon-name="upvote-outline"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.877 19H7.123A1.125 1.125 0 0 1 6 17.877V11H2.126a1.114 1.114 0 0 1-1.007-.7 1.249 1.249 0 0 1 .171-1.343L9.166.368a1.128 1.128 0 0 1 1.668.004l7.872 8.581a1.25 1.25 0 0 1 .176 1.348 1.113 1.113 0 0 1-1.005.7H14v6.877A1.125 1.125 0 0 1 12.877 19ZM7.25 17.75h5.5v-8h4.934L10 1.31 2.258 9.75H7.25v8ZM2.227 9.784l-.012.016c.01-.006.014-.01.012-.016Z">
                            </path>
                        </svg>
                        <svg rpl="" fill="currentColor" class="cursor-pointer downvote-button {{ $downvoteClass }}"
                            data-reply-id="{{ $response->id }}" height="20" icon-name="downvote-outline"
                            viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 20a1.122 1.122 0 0 1-.834-.372l-7.872-8.581A1.251 1.251 0 0 1 1.118 9.7 1.114 1.114 0 0 1 2.123 9H6V2.123A1.125 1.125 0 0 1 7.123 1h5.754A1.125 1.125 0 0 1 14 2.123V9h3.874a1.114 1.114 0 0 1 1.007.7 1.25 1.25 0 0 1-.171 1.345l-7.876 8.589A1.128 1.128 0 0 1 10 20Zm-7.684-9.75L10 18.69l7.741-8.44H12.75v-8h-5.5v8H2.316Zm15.469-.05c-.01 0-.014.007-.012.013l.012-.013Z">
                            </path>
                        </svg>
                        <span id="vote-count">{{ $response->votes }}
                            {{ $response->votes === 1 || $response->votes === -1 ? 'vote' : 'votes' }}</span>
                    </span>
                    <span class="text-gray-600 dark:text-gray-500">·</span>
                @endif
                @if (auth()->check() && $response->user->id === auth()->user()->id)
                    <span class="text-gray-600 dark:text-gray-500">·</span>
                    <button type="button" class="text-yellow-400 dark:text-yellow-500 underline edit-element-button"
                        data-reply-id={{ $response->id }}>Edit</button>
                    <span class="text-gray-600 dark:text-gray-500">·</span>
                    <button type="button" class="text-red-700 dark:text-red-500 underline delete-element-button"
                        data-reply-id={{ $response->id }}>Delete</button>
                @endif
            </div>
        </div>
    @empty
        <div>
            <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                <img alt="404-logo" class="w-10 h-10" loading="lazy" decoding="async" data-nimg="1"
                    src={{ asset('./assets/svgs/404-error.svg') }}>
            </div>
            <h3 class="mb-2 text-xl font-bold dark:text-white">Oups no responses were found</h3>
            <p class="text-gray-500 dark:text-gray-400">Be the first one to post an answer to
                {{ $post->user->name }}s
                post</p>
        </div>
    @endforelse
</div>
</div>
