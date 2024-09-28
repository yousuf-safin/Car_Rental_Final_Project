<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Customer Details</h1>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                <div class="mb-4">
                    <strong class="text-lg font-medium text-gray-700 dark:text-gray-300">Customer Name:</strong>
                    <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->name }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-lg font-medium text-gray-700 dark:text-gray-300">Email:</strong>
                    <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->email }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-lg font-medium text-gray-700 dark:text-gray-300">Phone Number:</strong>
                    <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->phone }}</p>
                </div>
                <div class="mb-4">
                    <strong class="text-lg font-medium text-gray-700 dark:text-gray-300">Address:</strong>
                    <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $customer->address }}</p>
                </div>
                <!-- Handle date fields if any -->
                @if(isset($customer->date_of_birth))
                    <div class="mb-4">
                        <strong class="text-lg font-medium text-gray-700 dark:text-gray-300">Date of Birth:</strong>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">
                            @if ($customer->date_of_birth instanceof \Carbon\Carbon)
                                {{ $customer->date_of_birth->format('Y-m-d') }}
                            @else
                                {{ $customer->date_of_birth }} <!-- Display raw date if not Carbon -->
                            @endif
                        </p>
                    </div>
                @endif
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('customers.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    Back to Customers
                </a>
                <a href="{{ route('customers.edit', $customer->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">
                    Edit
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
