<!-- backend/resources/views/dashboard/blogs/create.blade.php -->
<x-layout title="Add Blog">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!--Header -->
        <div class="bg-white rounded-xl shadow-lg mb-6 p-6 " dir="rtl">
          <h1 class="text-3xl font-bold text-gray-800">اضافة مدونة جديدة</h1>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start ">

                    <!-- Title -->
                    <x-form.Input name="title" label="العنوان" type="text" icon="fas fa-pencil-alt"
                        placeholder="أدخل العنوان هنا" required />

                    <!-- Categories -->
                    <x-form.Input name="categories" label="الفئات" type="text" icon="fas fa-list"
                        placeholder="أدخل الفئات (مفصولة بفواصل)" />

                </div>

                <!-- Content -->
                <div>
                    <x-form.textarea name="content" label="المحتوى" placeholder="ادخل المحتوى هنا ....."
                        icon="fas fa-clipboard-list" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start ">

                    <!-- Status -->
                    <x-form.select name="status" label="الحالة" icon="fas fa-info-circle" :options="
                        [
            'draft' => 'مسودة',
            'published' => 'منشور'
        ]" placeholder="اختر الحالة" required />

                    <!-- Tags -->
                    <x-form.Input name="tags" label="العلامات" type="text" icon="fas fa-hashtag"
                        placeholder="أدخل العلامات (مفصولة بفواصل)" />
                </div>



                <!-- Images Upload -->
                <div>
                    <label class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-images ml-2 text-indigo-600"></i> الصور
                    </label>

                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="images"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span class="ml-1" >Upload images</span>
                                    <input id="images" name="images[]" type="file" class="sr-only" multiple
                                        accept="image/*" onchange="handleImagePreview(this)">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>

                    <!-- Image Preview Container -->
                    <div id="imagePreviewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    </div>

                    @error('images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start ">
                    <!-- Meta Title -->
                    <x-form.Input name="meta_title" label="عنوان ( Meta )" type="text" icon="fas fa-tag"
                        placeholder="أدخل عنوان الميتا" />

                    <!-- Meta Keywords -->
                    <x-form.Input name="meta_keywords" label="كلمات ( Meta ) المفتاحية" type="text" icon="fas fa-key"
                        placeholder="أدخل كلمات الميتا (مفصولة بفواصل)" />

                </div>

                <!-- Meta Description -->
                <div>
                    <x-form.textarea name="meta_description" label="وصف ( Meta )"
                        placeholder="ادخل وصف الميتا هنا ....." icon="fas fa-clipboard-list" />
                </div>


                <!-- Submit Button -->
                <div class="flex justify-start">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-900 via-indigo-800 to-indigo-900
               text-white rounded-md shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
               transition-all duration-300">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="font-normal">إنشاء مقال</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
function handleImagePreview(input) {
    const previewContainer = document.getElementById('imagePreviewContainer');
    previewContainer.innerHTML = ''; // Clear previous previews

    if (input.files && input.files.length > 0) {
        const dataTransfer = new DataTransfer();

        Array.from(input.files).forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function (e) {
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'relative group';

                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'w-full h-40 object-contain rounded-lg';

                const removeButton = document.createElement('button');
                removeButton.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity';
                removeButton.innerHTML = '×';
                removeButton.type = 'button';
                removeButton.onclick = function () {
                    previewWrapper.remove();
                    // Remove file from DataTransfer object
                    const newDataTransfer = new DataTransfer();
                    Array.from(input.files)
                        .filter((_, i) => i !== index)
                        .forEach(file => newDataTransfer.items.add(file));
                    input.files = newDataTransfer.files;
                };

                previewWrapper.appendChild(preview);
                previewWrapper.appendChild(removeButton);
                previewContainer.appendChild(previewWrapper);
            };

            reader.readAsDataURL(file);
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    }
}
    </script>
</x-layout>
