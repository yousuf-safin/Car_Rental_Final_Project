<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold dark:text-white">Edit Rental</h1>
            </div>

            <form action="{{ route('rentals.update', $rental->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Rental ID (Hidden) -->
                <input type="hidden" name="id" value="{{ $rental->id }}">

                <!-- Start Date -->
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $rental->start_date->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <!-- End Date -->
                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date:</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $rental->end_date->format('Y-m-d') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600">
                        <option value="Ongoing" {{ $rental->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ $rental->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Canceled" {{ $rental->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex space-x-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                        Update Rental
                    </button>
                    <a href="{{ route('rentals.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
