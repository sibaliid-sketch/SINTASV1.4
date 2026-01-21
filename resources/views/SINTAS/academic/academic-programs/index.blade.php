<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Academic Offerings Management') }}
            </h2>
            <a href="{{ route('admin.programs.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Offering
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="ml-2 text-lg font-medium text-gray-900">
                            Programs Overview
                        </h3>
                    </div>
                </div>

                <!-- Filters -->
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Types</option>
                                <option value="program" {{ request('type') == 'program' ? 'selected' : '' }}>Program</option>
                                <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Service</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service</label>
                            <select name="service_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Services</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Education Level</label>
                            <select name="education_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Levels</option>
                                <option value="TK/Sederajat" {{ request('education_level') == 'TK/Sederajat' ? 'selected' : '' }}>TK/Sederajat</option>
                                <option value="SD/Sederajat" {{ request('education_level') == 'SD/Sederajat' ? 'selected' : '' }}>SD/Sederajat</option>
                                <option value="SMP/Sederajat" {{ request('education_level') == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                <option value="SMA/Sederajat" {{ request('education_level') == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                                <option value="Mahasiswa" {{ request('education_level') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Umum" {{ request('education_level') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Media</label>
                            <select name="media" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Media</option>
                                <option value="online" {{ request('media') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ request('media') == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="is_active" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Status</option>
                                <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Search</label>
                            <div class="flex">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="mt-1 block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Search programs...">
                                <button type="submit" class="mt-1 px-4 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <!-- Programs Table -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <h4 class="text-lg font-medium text-gray-900">
                                Programs ({{ $programs->total() }} total)
                            </h4>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Media</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Margin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($programs as $program)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center">
                                                        <span class="text-white font-medium text-sm">{{ substr($program->name, 0, 2) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $program->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($program->description, 40) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $program->type === 'program' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                                {{ ucfirst($program->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($program->service)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $program->service->name }}
                                            </span>
                                            @else
                                            <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $program->education_level }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                {{ $program->media === 'online' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ ucfirst($program->media) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $program->formatted_price }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="font-medium {{ $program->profit_margin >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $program->formatted_profit_margin }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($program->is_active)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.programs.show', $program) }}"
                                                   class="text-blue-600 hover:text-blue-900">View</a>
                                                <a href="{{ route('admin.programs.edit', $program) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form method="POST" action="{{ route('admin.programs.toggle', $program) }}"
                                                      class="inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="text-{{ $program->is_active ? 'red' : 'green' }}-600 hover:text-{{ $program->is_active ? 'red' : 'green' }}-900">
                                                        {{ $program->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                            No programs found matching your criteria.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($programs->hasPages())
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            {{ $programs->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
