<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold dark:text-white">Rental Details</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('rentals.edit', $rental->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">
                        Edit
                    </a>
                    <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this rental?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-md">
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Rental ID:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rental->id }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Customer Name:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rental->user->name }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Car Details:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rental->car->name }} ({{ $rental->car->brand }})</p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Start Date:</strong>
                    <p class="text-gray-900 dark:text-gray-100">
                        @if ($rental->start_date instanceof \Carbon\Carbon)
                            {{ $rental->start_date->format('Y-m-d') }}
                        @else
                            {{ $rental->start_date }} <!-- Display raw date if not Carbon -->
                        @endif
                    </p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">End Date:</strong>
                    <p class="text-gray-900 dark:text-gray-100">
                        @if ($rental->end_date instanceof \Carbon\Carbon)
                            {{ $rental->end_date->format('Y-m-d') }}
                        @else
                            {{ $rental->end_date }} <!-- Display raw date if not Carbon -->
                        @endif
                    </p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Total Cost:</strong>
                    <p class="text-gray-900 dark:text-gray-100">${{ number_format($rental->total_cost, 2) }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700 dark:text-gray-300">Status:</strong>
                    <p class="text-gray-900 dark:text-gray-100">{{ $rental->status }}</p>
                </div>

                <a href="{{ route('rentals.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Back to Rentals
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
