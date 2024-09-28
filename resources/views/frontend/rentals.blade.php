<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 p-4 sm:rounded-lg shadow-md mb-8 mt-5">
            <form action="{{ route('frontedrentals') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Car Type Filter -->
                <div class="flex flex-col">
                    <label for="car_type" class="text-gray-700 dark:text-gray-300">Pick A Car</label>
                    <select name="car_type" id="car_type" class="mt-2 p-2 border dark:border-gray-600 rounded-lg dark:bg-gray-700">
                        <option value="">All</option>
                        @foreach($carTypes as $type)
                            <option value="{{ $type }}" {{ request('car_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="flex flex-col">
                    <label for="brand" class="text-gray-700 dark:text-gray-300">Pick A Brand</label>
                    <select name="brand" id="brand" class="mt-2 p-2 border dark:border-gray-600 rounded-lg dark:bg-gray-700">
                        <option value="">All</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Daily Rent Price Filter -->
                <div class="flex flex-col">
                    <label for="price_range" class="text-gray-700 dark:text-gray-300">Choose Daily Rent Price</label>
                    <input type="number" name="price_range" id="price_range" class="mt-2 p-2 border dark:border-gray-600 rounded-lg dark:bg-gray-700" value="{{ request('price_range') }}" placeholder="500">
                </div>

                <!-- Submit Button -->
                <div >
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
        <div class="flex justify-center mt-8">
            <h1 class="text-3xl font-bold text-black dark:text-white decoration-black decoration-2">Pick The Car You Want To Rent</h1>
        </div>
        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 ">
            
            @foreach($cars as $car)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mt-8">
                    <!-- Car Image -->
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="w-full h-48 object-cover">

                    <!-- Car Details -->
                    <div class="p-6  text-center">
                        <h2 class="text-xl font-bold dark:text-white">{{ $car->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">Brand: {{ $car->brand }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Model: {{ $car->model }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Price: ${{ number_format($car->daily_rent_price, 2) }} / day</p>

                        <!-- Rent Car Button -->
                        <a href="{{ route('frontedrentals.create', $car->id) }}" class="block mt-4 bg-purple-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-center">
                            Rent Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $cars->links() }}
        </div>
    </div>
</x-app-layout>
