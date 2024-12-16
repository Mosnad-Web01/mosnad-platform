<x-layout title="Update Activity">
    <x-common.header title="تعديل النشاط" :showBackButton="true" />

    <x-common.content-container>
        <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Card Wrapper -->
            <div class="bg-white  overflow-hidden ">
                <!-- Basic Information Section -->
                <div class="p-8 border-b">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">المعلومات الأساسية</h3>
                    
                    <!-- Activity Title -->
                    <div class="flex flex-col gap-2">
                        <label for="title" class="text-sm font-medium text-gray-600">اسم النشاط *</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $activity->title) }}" 
                            class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                            placeholder="أدخل اسم النشاط" 
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Activity Description -->
                    <div class="flex flex-col gap-2 mt-6">
                        <label for="description" class="text-sm font-medium text-gray-600">وصف النشاط *</label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4" 
                            class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                            placeholder="أدخل وصف النشاط" 
                            required
                        >{{ old('description', $activity->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Date and Location Section -->
                <div class="p-8 border-b">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">الزمان والمكان</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Activity Date -->
                        <div class="flex flex-col gap-2">
                            <label for="activity_date" class="text-sm font-medium text-gray-600">تاريخ النشاط *</label>
                            <input 
                                type="datetime-local" 
                                id="activity_date" 
                                name="activity_date" 
                                value="{{ old('activity_date', $activity->activity_date) }}" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                                required
                            >
                            @error('activity_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Activity Location -->
                        <div class="flex flex-col gap-2">
                            <label for="location" class="text-sm font-medium text-gray-600">الموقع *</label>
                            <input 
                                type="text" 
                                id="location" 
                                name="location" 
                                value="{{ old('location', $activity->location) }}" 
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                                placeholder="أدخل الموقع"
                                required
                            >
                            @error('location')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Existing and New Images Section -->
                <div class="p-8 border-b">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">الوسائط</h3>
                    
                    <!-- Current Images -->
                    @if($activity->images)
                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-600 mb-2">الصور الحالية:</p>
                            <div class="flex gap-4">
                                @foreach($activity->images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Activity Image" class="h-20 w-20 rounded-lg shadow-md">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Images -->
                    <div class="flex flex-col gap-4">
                        <label for="images" class="text-sm font-medium text-gray-600">إضافة صور جديدة</label>
                        <input 
                            type="file" 
                            id="images" 
                            name="images[]" 
                            multiple 
                            class="px-1 py-2 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                        >
                        @error('images')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status Section -->
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">الحالة</h3>
                    <div class="flex flex-col gap-2">
                        <label for="status" class="text-sm font-medium text-gray-600">حالة النشاط *</label>
                        <select 
                            name="status" 
                            id="status" 
                            class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                            required
                        >
                            <option value="published" {{ old('status', $activity->status) == 'published' ? 'selected' : '' }}>نشط</option>
                            <option value="draft" {{ old('status', $activity->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-blue-500 text-white font-medium rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all"
                >
                    تحديث النشاط    
                </button>
            </div>
        </form>
    </x-common.content-container>
</x-layout>
