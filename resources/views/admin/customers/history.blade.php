<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-2xl font-bold mb-4 dark:text-white">{{ $customer->name }} Rentals</h1>

            <!-- Current Rentals -->
            <div class="mb-6">
                @if (session('status'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                <h2 class="text-xl font-semibold mb-2 dark:text-white">Current Bookings</h2>
                @if($currentRentals->isEmpty())
                    <p class="text-gray-700 dark:text-gray-300">You have no current bookings.</p>
                @else
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach($currentRentals as $rental)
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-medium dark:text-white">{{ $rental->car->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Booking from <strong>{{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</strong> to
                                        <strong>{{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</strong>
                                    </p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded">{{$rental->status}}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Past Rentals -->
            <div>
                <h2 class="text-xl font-semibold mb-2 dark:text-white">Past Bookings</h2>
                @if($pastRentals->isEmpty())
                    <p class="text-gray-700 dark:text-gray-300">You have no past bookings.</p>
                @else
                    <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                        @foreach($pastRentals as $rental)
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <p class="text-lg font-medium dark:text-white">{{ $rental->car->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Booking from <strong>{{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</strong> to
                                        <strong>{{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</strong>
                                    </p>
                                </div>
                                <span class="bg-gray-100 text-gray-800 text-sm font-semibold px-2.5 py-0.5 rounded">Completed</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
