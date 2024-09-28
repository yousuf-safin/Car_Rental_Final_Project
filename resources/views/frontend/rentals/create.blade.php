<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-2xl font-bold mb-4 dark:text-white">Rent {{ $car->name }}</h1>

            <!-- Display existing booking periods -->
            @if ($unavailableDates->isNotEmpty())
                <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-lg">
                    <h2 class="font-bold text-lg">Unavailable Booking Periods</h2>
                    <ul class="list-disc pl-5">
                        @foreach ($unavailableDates as $unavailable)
                            <li>
                                From <strong>{{ \Carbon\Carbon::parse($unavailable->start_date)->format('M d, Y') }}</strong>
                                to <strong>{{ \Carbon\Carbon::parse($unavailable->end_date)->format('M d, Y') }}</strong>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    <h2 class="font-bold text-lg">All dates are currently available for booking!</h2>
                </div>
            @endif

            <!-- Rental Form -->
            <form action="{{ route('frontedrentals.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">

                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:text-white dark:border-gray-600" required>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                    Confirm Rental
                </button>
            </form>
        </div>
    </div>

    <!-- Pass unavailable dates to JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const unavailableDates = @json($unavailableDates);

            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            // Function to check if a date is within an unavailable range
            function isUnavailable(date) {
                for (const range of unavailableDates) {
                    const startDate = new Date(range.start_date);
                    const endDate = new Date(range.end_date);
                    if (date >= startDate && date <= endDate) {
                        return true;
                    }
                }
                return false;
            }

            // Disable unavailable dates in date inputs
            function disableUnavailableDates(input) {
                input.addEventListener('input', function() {
                    const selectedDate = new Date(this.value);
                    if (isUnavailable(selectedDate)) {
                        alert('Selected date is unavailable. Please choose another date.');
                        this.value = ''; // Clear the invalid date
                    }
                });
            }

            // Disable past dates
            const today = new Date().toISOString().split('T')[0];
            startDateInput.setAttribute('min', today);
            endDateInput.setAttribute('min', today);

            // Disable unavailable dates
            disableUnavailableDates(startDateInput);
            disableUnavailableDates(endDateInput);
        });
    </script>
</x-app-layout>
