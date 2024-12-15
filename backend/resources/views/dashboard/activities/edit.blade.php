<x-layout title="Edit Activity">
    <x-common.header title="تعديل النشاط" :showBackButton="true" />

    <x-common.content-container title="تفاصيل النشاط">
        <form action="{{ route('activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Activity Title -->
            <div class="flex flex-col">
                <label for="title" class="text-sm font-medium text-gray-700">اسم النشاط</label>
                <input type="text" id="title" name="title" value="{{ old('title', $activity->title) }}" class="mt-1 p-2 border rounded-md" placeholder="أدخل اسم النشاط" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Description -->
            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-700">وصف النشاط</label>
                <textarea id="description" name="description" rows="4" class="mt-1 p-2 border rounded-md" placeholder="أدخل وصف النشاط" required>{{ old('description', $activity->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Date -->
            <div class="flex flex-col">
                <label for="activity_date" class="text-sm font-medium text-gray-700">تاريخ النشاط</label>
                <input type="datetime-local" id="activity_date" name="activity_date" value="{{ old('activity_date', $activity->activity_date->format('Y-m-d\TH:i')) }}" class="mt-1 p-2 border rounded-md" required>
                @error('activity_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Location -->
            <div class="flex flex-col">
                <label for="location" class="text-sm font-medium text-gray-700">الموقع</label>
                <input type="text" id="location" name="location" value="{{ old('location', $activity->location) }}" class="mt-1 p-2 border rounded-md" placeholder="أدخل الموقع">
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Images -->
            <div class="flex flex-col">
                <label for="images" class="text-sm font-medium text-gray-700">صور النشاط</label>
                <input type="file" id="images" name="images[]" multiple class="mt-1 p-2 border rounded-md" onchange="previewImages()">
                @error('images')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Previews -->
                <div id="image-previews" class="mt-4">
                    @if($activity->images)
                        @foreach(json_decode($activity->images, true) as $image)
                            <div class="inline-block relative mr-2 mb-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Activity Image" class="w-32 h-32 object-cover rounded-md">
                                <button type="button" class="absolute top-0 right-0 text-red-500" onclick="removeImagePreview(this)">×</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Activity Status -->
            <div class="flex flex-col">
                <label for="status" class="text-sm font-medium text-gray-700">الحالة</label>
                <select name="status" id="status" class="mt-1 p-2 border rounded-md" required>
                    <option value="published" {{ old('status', $activity->status) == 'published' ? 'selected' : '' }}>نشط</option>
                    <option value="draft" {{ old('status', $activity->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">تحديث النشاط</button>
            </div>
        </form>
    </x-common.content-container>
</x-layout>

<script>
    // Preview the selected images before upload
    function previewImages() {
        const fileInput = document.getElementById('images');
        const previewContainer = document.getElementById('image-previews');
        previewContainer.innerHTML = ''; // Clear existing previews

        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-md', 'mr-2', 'mb-2');
                const removeButton = document.createElement('button');
                removeButton.classList.add('absolute', 'top-0', 'right-0', 'text-red-500');
                removeButton.textContent = '×';
                removeButton.onclick = function () {
                    previewContainer.removeChild(img);
                    previewContainer.removeChild(removeButton);
                };

                const div = document.createElement('div');
                div.classList.add('inline-block', 'relative');
                div.appendChild(img);
                div.appendChild(removeButton);
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    // Remove the image preview
    function removeImagePreview(button) {
        const previewContainer = document.getElementById('image-previews');
        previewContainer.removeChild(button.parentElement);
    }
</script>
