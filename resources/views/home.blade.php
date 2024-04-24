<x-main_layout>
    @session('status')
        <div class="p-4 mb-4 text-sm text-green-500 rounded-lg bg-red-50 dark:bg-gray-700" role="alert">
            <span class="font-medium">Status:</span> {{ $value }}
        </div>
    @endsession
    <x-hero />
    <x-about />
    <x-topbuddies />
    <x-tech />
    <x-forums :topThreePopularForums="$topThreePopularForums" />
</x-main_layout>
