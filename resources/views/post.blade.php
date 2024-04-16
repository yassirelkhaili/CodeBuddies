<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-24">
        <div class="px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="flex flex-row justify-between items-center">
                <div class="max-w-screen-md mb-4 lg:mb-8">
                    <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">{{$post->title}}</h2>
                    <div class="flex flex-row gap-2 items-center mb-4">
                        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start" class="aspect-square h-7 rounded cursor-pointer"
                        src="{{ asset('storage/' . $post->user->avatar) }}"
                        alt="{{ $post->user->name }}'s Avatar">
                        <p class="text-blue-700 dark:text-blue-500 text-lg font-semibold">{{ $post->user->name }} <span class="text-gray-600 dark:text-gray-500">·</span> {{ $post->created_at->format('d M') }} <span class="text-gray-600 dark:text-gray-500">·</span> {{ $post->responses()->count() }} {{ $post->responses()->count() === 1 ? 'response' : 'responses' }}
                        </p>
                    </div>
                    <p class="text-gray-500 sm:text-xl dark:text-gray-400">{{$post->content}}</p>
                </div>
            </div>
            <div class="pb-2 mx-auto max-w-screen-xl sm:pb-6">
            @include("layouts.replies")
            </div>
        </div>
      </section>
</x-main_layout>