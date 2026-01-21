<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent leading-tight">
            {{ __('Attendance Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50 mb-8">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Attendance Records</h3>
                            <p class="text-gray-600">View and filter employee attendance data from Fingerspot devices.</p>
                        </div>
                    </div>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('attendance.index') }}" class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                                <input type="date" 
                                       id="start_date" 
                                       name="start_date" 
                                       value="{{ request('start_date') }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                                <input type="date" 
                                       id="end_date" 
                                       name="end_date" 
                                       value="{{ request('end_date') }}"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- PIN Search -->
                            <div>
                                <label for="pin" class="block text-sm font-medium text-gray-700 mb-2">Employee PIN</label>
                                <input type="text" 
                                       id="pin" 
                                       name="pin" 
                                       value="{{ request('pin') }}"
                                       placeholder="Search by PIN"
                                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Device Filter -->
                            <div>
                                <label for="device_id" class="block text-sm font-medium text-gray-700 mb-2">Device</label>
                                <select id="device_id" 
                                        name="device_id"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">All Devices</option>
                                    @foreach($devices as $device)
                                        <option value="{{ $device }}" {{ request('device_id') == $device ? 'selected' : '' }}>
                                            {{ $device }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" 
                                    class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-600 transition-colors shadow-md">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Apply Filters
                            </button>
                            <a href="{{ route('attendance.index') }}" 
                               class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </a>
                            <button type="button" 
                                    class="ml-auto bg-gradient-to-r from-green-500 to-teal-500 text-white px-6 py-2 rounded-lg hover:from-green-600 hover:to-teal-600 transition-colors shadow-md"
                                    onclick="alert('Export functionality will be implemented soon!')">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export to Excel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="bg-white/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200/50">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Attendance Records
                            <span class="text-sm font-normal text-gray-500 ml-2">
                                ({{ $attendances->total() }} total records)
                            </span>
                        </h3>
                    </div>

                    @if($attendances->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            PIN
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Date & Time
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Device ID
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($attendances as $attendance)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                                    {{ substr($attendance->pin, 0, 2) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-900">{{ $attendance->pin }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $attendance->date_time->format('d M Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $attendance->date_time->format('H:i:s') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ $attendance->device_id }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Recorded
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="showDetails({{ json_encode($attendance->raw_payload) }})" 
                                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $attendances->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No attendance records found</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                @if(request()->hasAny(['start_date', 'end_date', 'pin', 'device_id']))
                                    Try adjusting your filters or <a href="{{ route('attendance.index') }}" class="text-blue-600 hover:text-blue-800">reset them</a>.
                                @else
                                    Attendance records will appear here once the Fingerspot API integration is active.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal (Simple Alert for now) -->
    <script>
        function showDetails(payload) {
            alert('Raw Payload:\n\n' + JSON.stringify(payload, null, 2));
        }
    </script>
</x-app-layout>
