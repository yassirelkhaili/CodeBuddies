<x-main_layout>
    <section class="bg-white dark:bg-gray-900 pt-64 h-screen">
        <div class="max-w-screen-xl px-4 mx-auto text-center lg:px-6">
            <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-4 dark:text-white">
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-bold">{{ \App\Models\User::count() }}</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">developers</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-bold">{{ \App\Models\Response::where("answer", 1)->count() }}</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">resolved issues</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-bold">{{ \App\Models\Post::count() }}+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">posts</dd>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <dt class="mb-2 text-3xl md:text-4xl font-bold">{{ \App\Models\Response::count() }}+</dt>
                    <dd class="font-light text-gray-500 dark:text-gray-400">responses</dd>
                </div>
            </dl>
        </div>
    </section>    
</x-main_layout>