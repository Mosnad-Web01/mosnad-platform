<x-layout title="إدارة الأدوار">
    <x-common.header title="أدوار المديرين" :showBackButton="true" />

    <x-common.content-container title="جدول أدوار المديرين">

            <x-table
                :headers="['Name', 'Description', 'Permissions', 'Assign User', 'Actions']"
                :items="$adminRoles"
                :hasActions="false"
                :withPagination="false"
                dir="ltr"
             >
                @foreach($adminRoles as $adminRole)
                    <tr class="transition-colors hover:bg-gray-50">
                        <!-- Name -->
                        <x-table.cell>
                            <span class="font-medium text-gray-900">{{ $adminRole->name }}</span>
                        </x-table.cell>

                        <!-- Description -->
                        <x-table.cell>
                            <span class="text-gray-600">{{ $adminRole->description }}</span>
                        </x-table.cell>

                        <!-- Permissions -->
                        <x-table.cell>
                            <div class="flex flex-wrap gap-2 justify-center" dir="rtl">
                                <!--checks if role has no permissions-->
                                @if (count($adminRole->permissions) == 0)

                                <div class=" w-full flex justify-center items-center px-3 py-1 text-xs font-medium ">
                                        <div class="  bg-red-100 text-red-800 rounded-full px-2 py-1">
                                            <div class="text-red-700 text-xs font-medium">
                                                لا يوجد صلاحيات
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    @foreach($adminRole->permissions as $permission)
                                        <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </x-table.cell>

                        <!-- Assign User -->
                        <x-table.cell>
                            <div class="flex space-x-3">
                                <button onclick="openAssignModal('{{ $adminRole->id }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>

                                    Assign
                                </button>
                            </div>
                        </x-table.cell>

                        <!-- Actions -->
                        <x-table.cell>
                            <x-table.action-buttons :editUrl="route('admin-roles.edit', $adminRole->id)"
                                :deleteUrl="route('admin-roles.destroy', $adminRole->id)" :deleteConfirmationMessage="'هل أنت متأكد من حذف هذا الدور؟'" />
                        </x-table.cell>
                    </tr>
                @endforeach
            </x-table>
    </x-common.content-container>
    <!-- Assign Role Modal -->
    <div id="assignModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center"
        dir="ltr">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md transform transition-all duration-300">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Assign to User</h3>
                <div class="relative">
                    <input type="text" id="userSearch"
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Search users...">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
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
