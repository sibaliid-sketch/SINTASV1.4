<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Service') }}
            </h2>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                ← Back to Services
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg border border-gray-200 sm:rounded-2xl">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.services.store') }}" class="space-y-8">
                        @csrf

                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Basic Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Service Name *</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                                           placeholder="e.g., Privat, Regular, Rumah Belajar" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Service Code *</label>
                                    <input type="text" name="code" id="code" value="{{ old('code') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('code') border-red-500 @enderror"
                                           placeholder="e.g., PVT, REG, RBL" required style="text-transform: uppercase;">
                                    @error('code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('description') border-red-500 @enderror"
                                          placeholder="Describe the service...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Service Configuration -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                Service Configuration
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="class_mode" class="block text-sm font-medium text-gray-700 mb-2">Class Mode *</label>
                                    <select name="class_mode" id="class_mode"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('class_mode') border-red-500 @enderror" required>
                                        <option value="">Select class mode</option>
                                        <option value="online" {{ old('class_mode') == 'online' ? 'selected' : '' }}>Online</option>
                                        <option value="offline" {{ old('class_mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                                        <option value="both" {{ old('class_mode') == 'both' ? 'selected' : '' }}>Both</option>
                                    </select>
                                    @error('class_mode')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="features" class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                                    <input type="text" name="features" id="features" value="{{ old('features') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('features') border-red-500 @enderror"
                                           placeholder="e.g., Home visit, Group learning">
                                    @error('features')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Age Restrictions -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                Age Restrictions
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="min_age" class="block text-sm font-medium text-gray-700 mb-2">Minimum Age</label>
                                    <input type="number" name="min_age" id="min_age" value="{{ old('min_age') }}" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('min_age') border-red-500 @enderror"
                                           placeholder="e.g., 5">
                                    @error('min_age')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="max_age" class="block text-sm font-medium text-gray-700 mb-2">Maximum Age</label>
                                    <input type="number" name="max_age" id="max_age" value="{{ old('max_age') }}" min="0"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors @error('max_age') border-red-500 @enderror"
                                           placeholder="e.g., 18">
                                    @error('max_age')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Registration Settings -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Registration Settings
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="hidden" name="for_parent_register" value="0">
                                    <input type="checkbox" name="for_parent_register" id="for_parent_register" value="1" {{ old('for_parent_register') ? 'checked' : '' }}
                                           class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                                    <label for="for_parent_register" class="ml-3 block text-sm font-medium text-gray-700">
                                        Allow parent registration
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="hidden" name="for_self_register" value="0">
                                    <input type="checkbox" name="for_self_register" id="for_self_register" value="1" {{ old('for_self_register') ? 'checked' : '' }}
                                           class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                                    <label for="for_self_register" class="ml-3 block text-sm font-medium text-gray-700">
                                        Allow self registration
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                                    <label for="is_active" class="ml-3 block text-sm font-medium text-gray-700">
                                        Service is active
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                            <a href="{{ route('admin.services.index') }}"
                               class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                Create Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-uppercase service code
        document.getElementById('code').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</x-app-layout>
