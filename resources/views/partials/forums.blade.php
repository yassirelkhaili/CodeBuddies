@props(['topThreePopularForums'])

<section class="bg-white dark:bg-gray-900">
    <div class="pb-8 px-4 mx-auto max-w-screen-xl sm:pb-16 lg:px-6">
        <div class="max-w-screen-md mb-4 lg:mb-8">
            <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">Dive into Popular Forums
            </h2>
            <p class="text-gray-500 sm:text-xl dark:text-gray-400">Explore the most active and sought-after forums on
                CodeBuddies, where collaboration and learning come to life.</p>
        </div>
        <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
            @foreach ($topThreePopularForums as $popularForum)
                <div
                    class="flex justify-between items-start flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full lg:h-12 lg:w-12">
                        <span class="dark:text-blue-600 text-gray-700">
                            <i class="fa {{$popularForum->avatar}}" aria-hidden="true"></i>
                        </span>
                    </div>
                    <a href="{{route("forums.show", $popularForum->id)}}">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$popularForum->name}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">{{$popularForum->description}}</p>
                    <a href="{{route("forums.show", $popularForum->id)}}" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                        View this forum
                        <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                        </svg>
                    </a>
                </div>
            @endforeach

        </div>
</section>
