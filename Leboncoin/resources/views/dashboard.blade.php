<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage your ads') }}
            
        </h2>
    </x-slot>

    <x-success-status style="text-align:center" class="mb-4" :status="session('message')"/>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                @forelse ($userAds as $ad)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            @if ($ad->path)
                                <img src="{{ asset('storage/' . $ad->path) }}" alt="Image" class="mt-4 w-full h-auto">
                            @endif
                            <h2 class="text-xl font-semibold text-white">{{ $ad->title }}</h2>
                            <p class="text-gray-600 text-white">Category : {{ $ad->category }}</p>
                            <p class="text-gray-500 text-white">Description : {{ $ad->description }}</p>
                            <p class="mt-4 text-gray-600 text-white">Price : {{ $ad->price }} EUR</p>
                            <p class="text-gray-600 text-white">Location : {{ $ad->location }}</p>
                            <div class="mt-6 flex space-x-4">
                                <a href="{{ route('ads.edit', ['one_ad_id' => $ad->id]) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('ads.delete', ['one_ad_id' => $ad->id]) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-100">{{ __('You have no ads yet.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>