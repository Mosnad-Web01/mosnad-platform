<x-layout title="Create New Permission">
    <x-common.header title="Create New Permission" :showBackButton="true" />

    <x-common.content-container>
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('permissions.store') }}" method="POST"
                class="space-y-6 bg-white p-6 rounded-lg shadow">

                @csrf
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        اسم الصلاحية <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    <!--error messages -->
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700">
                        الرابط
                    </label>
                    <input type="text" name="slug"
                        class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 id=" slug"
                        required>
                    <!--error messages -->
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        الوصف
                    </label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <!--error messages -->
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        إنشاء الصلاحية
                    </button>
                </div>
            </form>
        </div>

    </x-common.content-container>

</x-layout>