<x-layout title="Permissions">
    <x-common.header title="Permissions" :showBackButton="true" />

    <!-- Permissions Content -->
    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative  rounded-xl shadow-lg bg-white">
                <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 mx-auto">
                    <table class="w-full " dir="ltr">
                        <thead>

                            <th class="px-4 sm:px-6 py-4 text-center text-md font-bold text-gray-950 whitespace-nowrap">ID
                            </th>
                            <th class="px-4 sm:px-6 py-4 text-center text-md font-bold text-gray-950 whitespace-nowrap">
                                Name
                            </th>

                            <th class="px-4 sm:px-6 py-4 text-center text-md font-bold text-gray-950 whitespace-nowrap">
                                Description
                            </th>

                            <th class="px-4 sm:px-6 py-4 text-center text-md font-bold text-gray-950 whitespace-nowrap">
                                Created At
                            </th>
                            <th class="px-4 sm:px-6 py-4 text-center text-md font-bold text-gray-950 whitespace-nowrap">
                                Action
                            </th>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($permissions as $permission)
                                <tr class="transition-colors hover:bg-gray-50">
                                    <td class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm text-gray-700">
                                        {{ $permission->id }}
                                    </td>
                                    <td
                                        class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-base font-light sm:font-medium text-gray-900">
                                        {{ $permission->name }}
                                    </td>
                                    <td
                                        class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-base font-light sm:font-medium text-gray-900">
                                        {{ $permission->description }}
                                    </td>
                                    <td
                                        class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-base font-light sm:font-medium text-gray-900">
                                        {{ $permission->created_at }}
                                    </td>
                                    <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                                        <div class="flex justify-center gap-2 items-center">
                                            <!-- Delete Icon -->
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذه الصلاحية ؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-700 hover:scale-110 transition duration-300 text-xs sm:text-sm">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>

                                            <!-- Edit Icon -->
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                                class="text-green-600 hover:text-green-800 hover:scale-110 transition duration-300 text-xs sm:text-sm">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
