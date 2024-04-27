<div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
    @forelse ($forums as $forum)
    <div class="hover:bg-gray-200 dark:hover:bg-gray-800 rounded-md hover:cursor-pointer relative">
        <a href={{route("forums.show", $forum->id)}} class="hover:bg-gray-200 dark:hover:bg-gray-800 rounded-md hover:cursor-pointer">
            <div class="p-5">
                <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                    <span class="dark:text-blue-600 text-gray-700">
                        <i class="fa {{$forum->avatar}}" aria-hidden="true"></i>
                    </span>
                </div>
                <h3 class="mb-2 text-xl font-bold dark:text-white">{{ $forum->name }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-ellipsis">{{ $forum->description }}</p>
            </div>
          </a>
          @can('manage', \App\Models\Forum::class)
          <div class="absolute top-6 right-6 text-gray-600 dark:text-gray-500">
              <svg class="dropdown-toggle-button" data-forum-id="{{$forum->id}}" fill="currentColor" height="16"
                  icon-name="overflow-horizontal-fill" viewBox="0 0 20 20" width="16"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M6 10a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z">
                  </path>
              </svg>
              <div id="dropdown{{ $forum->id }}"
                  class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute right-0">
                  <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                      <li>
                          <button type="button" data-forum-id={{ $forum->id }}
                              class="edit-forum-model-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Edit
                              forum</button>
                      </li>
                      <li>
                          <button type="button" data-forum-id={{ $forum->id }}
                              class="delete-forum-button block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">Delete
                              forum</button>
                      </li>
                  </ul>
              </div>
          </div>
      @endcan
      </div>
    @empty
        <div>
            <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                <img alt="404-logo" class="w-10 h-10" loading="lazy" decoding="async" data-nimg="1"
                    src={{ asset('./assets/svgs/404-error.svg') }}>
            </div>
            <h3 class="mb-2 text-xl font-bold dark:text-white">Oups no forums were found</h3>
            <p class="text-gray-500 dark:text-gray-400">If you encounter this message then a mistake must have occured,
                please refresh the page and try again</p>
        </div>
    @endforelse
</div>
<div class="mt-4">
    {{ $forums->links() }}
</div>
