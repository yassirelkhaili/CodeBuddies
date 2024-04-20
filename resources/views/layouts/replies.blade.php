<div>
    <h2 class="text-lg tracking-tight font-semibold text-gray-900 dark:text-white mb-5">Responses:</h2>
    @forelse ($responses as $response)
        <div @class(["mb-5", "pt-4 pb-3 border-green-700 dark:border-green-500 border-b-2 border-t-2" => $response->answer === 1])>
            <div class="flex flex-row gap-2 items-center justify-between mb-4">
                <div class="flex justify-center items-center gap-2">
                    <img id="avatarButton" type="button" data-dropdown-placement="bottom-start"
                    class="aspect-square h-7 rounded cursor-pointer"
                    src="{{ asset('storage/' . $response->user->avatar) }}" alt="{{ $response->user->name }}'s Avatar">
                <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $response->user->name }} <span
                        class="text-gray-600 dark:text-gray-500">·</span> {{ $response->created_at->format('d M') }}
                </p>
                </div>
                @if(auth()->check() && auth()->user()->id === $response->post->user_id && $response->answer === 0 && !\App\Repositories\ResponseRepository::isAnswerMarked($response->post->id))
                <button type="button" class="text-green-700 dark:text-green-500 underline mark-element-button" data-reply-id={{$response->id}}>Mark as answer</button>
                @endif
                @if($response->answer === 1)
                <div>
                    <span type="button" class="text-green-700 dark:text-green-500 mark-element-button" data-reply-id={{$response->id}}>Answer</span>
                @if(auth()->check() && auth()->user()->id === $response->post->user_id)
                <span class="text-gray-600 dark:text-gray-500">·</span>
                <span type="button" class="text-red-700 dark:text-red-500 cursor-pointer underline unmark-element-button" data-reply-id={{$response->id}}>Unmark answer</span>
                @endif
                </div>
                @endif
            </div>
            <p class="text-gray-500 sm:text-lg dark:text-gray-400">
                {!! \App\Services\CodeHighlightService::formatResponseContent($response->content) !!}
            </p>
            <div class="mt-1 flex flex-row gap-[0.5rem]">
                <a href="#" class="text-gray-600 dark:text-gray-500 hover:text-gray-900 hover:dark:text-gray-400">Report</a>
                @if(auth()->check() && $response->user->id === auth()->user()->id)
                    <span class="text-gray-600 dark:text-gray-500">·</span>
                    <button type="button"  class="text-yellow-400 dark:text-yellow-500 underline edit-element-button" data-reply-id={{$response->id}}>Edit</button>
                    <span class="text-gray-600 dark:text-gray-500">·</span>
                    <button type="button" class="text-red-700 dark:text-red-500 underline delete-element-button" data-reply-id={{$response->id}}>Delete</button>
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
