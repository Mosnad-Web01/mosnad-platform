<x-layout title="Create Activity">
    <x-common.header title="إضافة نشاط جديد" :showBackButton="true" />

    <x-common.content-container>
        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data" class="max-w-full mx-auto">
            @csrf

            <div class="bg-white rounded-2xl overflow-hidden">
                <div class="p-8 space-y-8">
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">المعلومات الأساسية</h3>
                        
                        <!-- Activity Title -->
                        <div class="flex flex-col">
                            <label for="title" class="text-sm font-medium text-gray-700 mb-2">اسم النشاط *</label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                value="{{ old('title') }}" 
                                class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                                placeholder="أدخل اسم النشاط" 
                                required
                            >
                            @error('title')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Activity Description -->
                        <div class="flex flex-col">
                            <label for="description" class="text-sm font-medium text-gray-700 mb-2">وصف النشاط *</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4" 
                                class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                                placeholder="أدخل وصف النشاط" 
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Date and Location Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">الزمان والمكان</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Activity Date -->
                            <div class="flex flex-col">
                                <label for="activity_date" class="text-sm font-medium text-gray-700 mb-2">تاريخ النشاط *</label>
                                <div class="relative">
                                    <input 
                                        type="datetime-local" 
                                        id="activity_date" 
                                        name="activity_date" 
                                        value="{{ old('activity_date') }}" 
                                        class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base w-full" 
                                        required
                                    >
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('activity_date')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Activity Location -->
                            <div class="flex flex-col">
                                <label for="location" class="text-sm font-medium text-gray-700 mb-2">الموقع *</label>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        id="location" 
                                        name="location" 
                                        value="{{ old('location') }}" 
                                        class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base w-full" 
                                        placeholder="أدخل الموقع"
                                    >
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                @error('location')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Media Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">الوسائط</h3>
                        
                        <!-- Activity Images -->
                        <div class="flex flex-col">
                            <label for="images" class="text-sm font-medium text-gray-700 mb-2">صور النشاط</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">
                                <div class="space-y-2">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M24 40V8" stroke-width="4" stroke-linecap="round" />
                                        <path d="M8 24l16-16 16 16" stroke-width="4" stroke-linecap="round"/>
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>اضغط لرفع الصور</span>
                                            <input 
                                                type="file" 
                                                id="images" 
                                                name="images[]" 
                                                multiple 
                                                class="sr-only"
                                                onchange="updateImageCount()"
                                            >
                                        </label>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                                        <p id="image-count" class="text-xs text-gray-600 mt-2">عدد الصور المحددة: 0</p>
                                    </div>
                                </div>
                            </div>
                            @error('images')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">الحالة</h3>
                        
                        <div class="flex flex-col">
                            <label for="status" class="text-sm font-medium text-gray-700 mb-2">حالة النشاط *</label>
                            <select 
                                name="status" 
                                id="status" 
                                class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-base" 
                                required
                            >
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>نشط</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button 
                            type="submit" 
                            class="w-full py-4 px-6 bg-blue-600 text-white text-lg font-medium rounded-xl focus:outline-none hover:bg-blue-700 transition-colors"
                        >
                            إضافة النشاط
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-common.content-container>

    <script>
        function updateImageCount() {
            const imageInput = document.getElementById('images');
            const imageCount = document.getElementById('image-count');
            imageCount.textContent = `عدد الصور المحددة: ${imageInput.files.length}`;
        }
    </script>
</x-layout>
