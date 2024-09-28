<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6 w-4/5">
                    
                    <!-- Total Cars Card -->
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold dark:text-white text-center">Total Cars</h2>
                        <h4 class="text-3xl font-bold mt-4 dark:text-white text-center">{{ $totalCars }}</h4>
                    </div>

                    <!-- Available Cars Card -->
                    <div class="bg-orange-400 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-white text-center">Available Cars</h2>
                        <h4 class="text-3xl font-bold mt-4 text-white text-center">{{ $availableCars }}</h4>
                    </div>

                    <!-- Total Rental Card -->
                    <div class="bg-indigo-500 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-white text-center">Total Rentals</h2>
                        <h4 class="text-3xl font-bold mt-4 text-white text-center">{{ $totalRental }}</h4>
                    </div>

                    <!-- Total Earning Card -->
                    <div class="bg-green-500 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-white text-center">Total Earnings</h2>
                        <h4 class="text-3xl font-bold mt-4 text-white text-center">{{ $totalEarning }}</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>