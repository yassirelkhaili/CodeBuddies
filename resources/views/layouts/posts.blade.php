<div class="space-y-8 grid grid-cols-1 md:gap-12 md:space-y-0">
    @forelse ($posts as $post)
      <a href="{{route("posts.show", $post->id)}}" class="hover:bg-gray-800 rounded-md hover:cursor-pointer">
        <div class="p-5">
            <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                <img alt="laravel-logo" loading="lazy" width="30" height="30" decoding="async" data-nimg="1"
                    style="color:transparent" src="https://cdn.cdnlogo.com/logos/l/23/laravel.svg">
            </div>
            <h3 class="mb-2 text-xl font-bold dark:text-white">{{ $post->title }}</h3>
        </div>
      </a>
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
