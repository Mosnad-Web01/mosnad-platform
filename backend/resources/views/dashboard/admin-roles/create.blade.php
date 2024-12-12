<x-layout title="Create New Role">
    <x-common.header title="Create New Role" :showBackButton="true" />

    <x-common.content-container>
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin-roles.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
                @csrf
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        <span class="text-red-500">*</span> الاسم
                    </label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        الوصف
                    </label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Permissions <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" name="permissions[]"
                                       value="{{ $permission->id }}"
                                       id="permission_{{ $permission->id }}"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="permission_{{ $permission->id }}"
                                       class="ml-2 block text-sm text-gray-900">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Admin Type
                    </button>
                </div>
            </form>
        </div>
    </x-common.content-container>
</x-layout>
