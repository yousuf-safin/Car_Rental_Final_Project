<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold dark:text-white">Edit Customer</h1>
            </div>

            <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone:</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $customer->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600">
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address:</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600">{{ old('address', $customer->address) }}</textarea>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex space-x-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                        Update Customer
                    </button>
                    <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
