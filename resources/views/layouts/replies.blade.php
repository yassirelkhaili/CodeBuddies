<div>
    <h2 class="text-lg tracking-tight font-semibold text-gray-900 dark:text-white mb-5">Responses:</h2>
    @forelse ($responses as $response)
        <div class="mb-5">
            <div class="flex flex-row gap-2 items-center mb-4">
                <img id="avatarButton" type="button" data-dropdown-placement="bottom-start"
                    class="aspect-square h-7 rounded cursor-pointer"
                    src="{{ asset('storage/' . $response->user->avatar) }}" alt="{{ $response->user->name }}'s Avatar">
                <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $response->user->name }} <span
                        class="text-gray-600 dark:text-gray-500">·</span> {{ $response->created_at->format('d M') }}
                </p>
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
