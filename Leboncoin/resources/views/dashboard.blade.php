<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage your ads') }}
   
        </h2>
    </x-slot>

    <x-success-status style="text-align:center" class="mb-4" :status="session('message')"/>

    <form action="{{ url('/dashboard') }}" method="GET">
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-bold mb-2">Category:</label>
                        <select id="category" name="category" class="border border-gray-300 rounded-md shadow-sm py-2 px-5 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">All categories</option>
                            @foreach (App\Models\Ads::distinct()->get(['category']) as $category)
                            <option value="{{ $category->category }}" {{ (request()->input('category') == $category->category) ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="location" class="block text-gray-700 font-bold mb-2">Location:</label>
                        <select id="location" name="location" class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">All locations</option>
                            @foreach (App\Models\Ads::distinct()->get(['location']) as $location)
                            <option value="{{ $location->location }}" {{ (request()->input('location') == $location->location) ? 'selected' : '' }}>{{ $location->location }}</option>
                            @endforeach
                        </select>
                        </div>
                    <div class="mb-4">
                        <label for="min_price" class="block text-gray-700 font-bold mb-2">Minimum price:</label>
                        <input id="min_price" name="min_price" type="text" class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request()->input('min_price') }}">
                    </div>
                    <div class="mb-4">
                        <label for="max_price" class="block text-gray-700 font-bold mb-2">Maximum price:</label>
                        <input id="max_price" name="max_price" type="text" class="border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ request()->input('max_price') }}">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Filter</button>
                    <button type="button" id="reset-filters" class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded ml-2">Reset</button>
                </form>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                @forelse ($userAds as $ad)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <!-- @if ($ad->path)
                                <img src="{{ asset('storage/' . $ad->path) }}" alt="Image" class="mt-4 w-full h-auto">
                            @endif -->

                            <div style="display:flex;justify-content:center;"><img style="max-width: 200px;max-height:200px" src="{{ $ad->path }}" alt="Description de l'image"></div>

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
    <script>
        document.getElementById('reset-filters').addEventListener('click', function() {
            document.getElementById('category').value = '';
            document.getElementById('location').value = '';
            document.getElementById('min_price').value = '';
            document.getElementById('max_price').value = '';
        });
    </script>
</x-app-layout>