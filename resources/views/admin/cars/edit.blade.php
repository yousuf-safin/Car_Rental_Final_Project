<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="rentals">
                <div class="action flex justify-between items-center dark:text-white mb-5">
                    <h1 class="text-xl font-bold">Edit Car - {{ $car->name }}</h1>
                    <a href="{{ route('cars.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                </div>

                <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Car Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" value="{{ old('name', $car->name) }}" required>
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Brand:</label>
                            <input type="text" name="brand" id="brand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" value="{{ old('brand', $car->brand) }}" required>
                        </div>

                        <!-- Model -->
                        <div>
                            <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model:</label>
                            <input type="text" name="model" id="model" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" value="{{ old('model', $car->model) }}" required>
                        </div>

                        <!-- Year -->
                        <div>
                            <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year:</label>
                            <input type="number" name="year" id="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" value="{{ old('year', $car->year) }}" required>
                        </div>

                        <!-- Car Type -->
                        <div>
                            <label for="car_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Car Type:</label>
                            <select name="car_type" id="car_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                                <option value="" disabled>Select Car Type</option>
                                <option value="New" {{ old('car_type', $car->car_type) == 'SUV' ? 'selected' : '' }}>SUV</option>
                                <option value="Old" {{ old('car_type', $car->car_type) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="Old" {{ old('car_type', $car->car_type) == 'Sports Car' ? 'selected' : '' }}>Sports Car</option>
                            </select>
                        </div>


                        <!-- Daily Rent Price -->
                        <div>
                            <label for="daily_rent_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Daily Rent Price:</label>
                            <input type="number" name="daily_rent_price" id="daily_rent_price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" value="{{ old('daily_rent_price', $car->daily_rent_price) }}" required>
                        </div>

                        <!-- Availability -->
                        <div class="sm:col-span-2">
                            <label for="availability" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Availability:</label>
                            <div class="mt-1 flex items-center">
                                <input type="checkbox" name="availability" id="availability" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ old('availability', $car->availability) ? 'checked' : '' }}>
                                <label for="availability" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Available</label>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="sm:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image:</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-900 dark:text-white dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="Car Image" class="mt-2 h-32 w-32 rounded-md">
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
