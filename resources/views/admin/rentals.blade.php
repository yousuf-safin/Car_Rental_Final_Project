<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <h1 class="text-2xl font-bold mb-4 dark:text-white">Manage Rentals</h1>

            @if(session('status'))
                <div class="bg-green-500 text-white font-bold p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-900">
                        <th class="px-4 py-2 dark:text-white">Rental ID</th>
                        <th class="px-4 py-2 dark:text-white">Customer Name</th>
                        <th class="px-4 py-2 dark:text-white">Car Details</th>
                        <th class="px-4 py-2 dark:text-white">Start Date</th>
                        <th class="px-4 py-2 dark:text-white">End Date</th>
                        <th class="px-4 py-2 dark:text-white">Total Cost</th>
                        <th class="px-4 py-2 dark:text-white">Status</th>
                        <th class="px-4 py-2 dark:text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                        <tr>
                            <td class="border px-4 py-2 dark:text-gray-300">{{ $rental->id }}</td>
                            <td class="border px-4 py-2 dark:text-gray-300">{{ $rental->user->name }}</td>
                            <td class="border px-4 py-2 dark:text-gray-300">{{ $rental->car->name }} ({{ $rental->car->brand }})</td>
                            <td class="border px-4 py-2 dark:text-gray-300">{{ $rental->start_date }}</td>
                            <td class="border px-4 py-2 dark:text-gray-300">{{ $rental->end_date }}</td>
                            <td class="border px-4 py-2 dark:text-gray-300">${{ number_format($rental->total_cost, 2) }}</td>
                            <td class="border px-4 py-2 dark:text-gray-300">
                                @if(now()->lessThan($rental->end_date))
                                    Ongoing
                                @else
                                    Completed
                                @endif
                            </td>
                            <td class="border px-4 py-2 dark:text-gray-300">
                                <a href="{{ route('admin.rentals.show', $rental->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                                
                                <form action="{{ route('admin.rentals.destroy', $rental->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border px-4 py-2 text-center dark:text-gray-300">No rentals available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
