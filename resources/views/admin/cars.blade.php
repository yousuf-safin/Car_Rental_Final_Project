<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="cars">
                <div class="flex justify-center items-center dark:text-white mb-5">
                    <h1 class="text-3xl font-bold text-center">Manage Cars</h1>                    
                </div>
                <div class="text-center mb-6">
                    <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">
                        Add Car
                    </a>
                    </div>
                <div class="car-list block w-full mt-3 overflow-x-auto">
                    <table class="w-full bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-100 dark:bg-gray-700 dark:text-white">
                            <tr class="text-left">
                                <th class="py-3 px-4">#</th>
                                <th class="py-3 px-4">Name</th>
                                <th class="py-3 px-4">Brand</th>
                                <th class="py-3 px-4">Model</th>
                                <th class="py-3 px-4">Year</th>
                                <th class="py-3 px-4">Car Type</th>
                                <th class="py-3 px-4">Daily Rent Price</th>
                                <th class="py-3 px-4">Availability</th>
                                <th class="py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="dark:text-white">
                            @if ($cars->count() > 0)
                                @foreach ($cars as $car)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="py-2 px-4">{{ $car->id }}</td>
                                        <td class="py-2 px-4">{{ $car->name }}</td>
                                        <td class="py-2 px-4">{{ $car->brand }}</td>
                                        <td class="py-2 px-4">{{ $car->model }}</td>
                                        <td class="py-2 px-4">{{ $car->year }}</td>
                                        <td class="py-2 px-4">{{ $car->car_type }}</td>
                                        <td class="py-2 px-4">{{ $car->daily_rent_price }}</td>
                                        <td class="py-2 px-4">
                                            {{ $car->availability ? 'Available' : 'Unavailable' }}
                                        </td>
                                        <td class="py-2 px-4 flex space-x-2">
                                            <a href="{{ route('cars.edit', $car) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Edit
                                            </a>
                                            <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="py-4 px-4 text-center dark:text-white">
                                        No cars found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>