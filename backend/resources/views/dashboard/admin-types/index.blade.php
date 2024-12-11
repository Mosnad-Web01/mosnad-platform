<x-layout title="Admin Types">
    <!-- Enhanced Header with Gradient Background -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <x-common.header title="Admin Types Management" class="container mx-auto px-4 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin-types.create') }}"
                   class="inline-flex items-center px-6 py-2.5 bg-white text-blue-800 rounded-full hover:bg-blue-50 transition-all duration-300 shadow-md transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Admin Type
                </a>
            </div>
        </x-common.header>
    </div>

    <x-common.content-container class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden" dir="ltr">
            <div class="p-6">
                <!-- Enhanced Search Bar -->
                <div class="mb-6">
                    <div class="relative">
                        <input type="text"
                               placeholder="Search admin types..."
                               class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                        <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Enhanced Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Permissions</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($adminTypes as $adminType)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $adminType->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-600">{{ $adminType->description }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($adminType->permissions as $permission)
                                                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <button onclick="openAssignModal('{{ $adminType->id }}')"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Assign
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-common.content-container>

    <!-- Enhanced Modal -->
    <div id="assignModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" dir="ltr">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Assign to User</h3>
                <div class="relative">
                    <input type="text"
                           id="userSearch"
                           class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                           placeholder="Search users...">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div id="userList" class="mt-4 max-h-60 overflow-y-auto"></div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button id="closeModal"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
