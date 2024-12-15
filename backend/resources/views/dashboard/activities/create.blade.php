<x-layout title="Create Activity">
    <x-common.header title="إضافة نشاط جديد" :showBackButton="true" />

    <x-common.content-container title="تفاصيل النشاط">
        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Activity Title -->
            <div class="flex flex-col">
                <label for="title" class="text-sm font-medium text-gray-700">اسم النشاط</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 p-2 border rounded-md" placeholder="أدخل اسم النشاط" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Description -->
            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-700">وصف النشاط</label>
                <textarea id="description" name="description" rows="4" class="mt-1 p-2 border rounded-md" placeholder="أدخل وصف النشاط" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Date -->
            <div class="flex flex-col">
                <label for="activity_date" class="text-sm font-medium text-gray-700">تاريخ النشاط</label>
                <input type="datetime-local" id="activity_date" name="activity_date" value="{{ old('activity_date') }}" class="mt-1 p-2 border rounded-md" required>
                @error('activity_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Location -->
            <div class="flex flex-col">
                <label for="location" class="text-sm font-medium text-gray-700">الموقع</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" class="mt-1 p-2 border rounded-md" placeholder="أدخل الموقع">
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Images -->
            <div class="flex flex-col">
                <label for="images" class="text-sm font-medium text-gray-700">صور النشاط</label>
                <input type="file" id="images" name="images[]" multiple class="mt-1 p-2 border rounded-md">
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Status -->
            <div class="flex flex-col">
                <label for="status" class="text-sm font-medium text-gray-700">الحالة</label>
                <select name="status" id="status" class="mt-1 p-2 border rounded-md" required>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>نشط</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">إضافة النشاط</button>
            </div>
        </form>
    </x-common.content-container>
</x-layout>
