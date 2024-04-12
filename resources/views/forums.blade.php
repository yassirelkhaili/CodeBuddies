<x-main_layout>
    <x-search />
    <section class="bg-white dark:bg-gray-900 pt-10">
        <div class="pb-8 px-4 mx-auto max-w-screen-xl sm:pb-16 lg:px-6">
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
               @forelse ($forums as $forum)
               <div class="hover:bg-gray-800 rounded-md p-5 hover:cursor-pointer">
                <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                    <img alt="laravel-logo" loading="lazy" width="30" height="30" decoding="async" data-nimg="1" style="color:transparent" src="https://cdn.cdnlogo.com/logos/l/23/laravel.svg">
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">{{$forum->name}}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-ellipsis">{{$forum->description}}</p>
            </div>
               @empty
               <div>
                <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                    <img alt="404-logo" class="w-10 h-10" loading="lazy" decoding="async" data-nimg="1" src={{asset('./assets/svgs/404-error.svg')}}>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">Oups no forums were found</h3>
                <p class="text-gray-500 dark:text-gray-400">If you encounter this message then a mistake must have occured, please refresh the page and try again</p>
            </div>
               @endforelse
        </div>
        {{-- <div class="mt-4">
            {{ $forums->links() }}
        </div> --}}
      </section>
</x-main_layout>
