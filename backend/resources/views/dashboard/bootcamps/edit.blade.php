<x-layout title="تعديل البوتكامب">
    <x-common.header title="تعديل البوتكامب - {{ $bootcamp->name }}" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">
            <!-- Edit Bootcamp Form -->
            <form action="{{ route('dashboard.bootcamps.update', $bootcamp->id) }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-lg">
                @csrf
                @method('PUT')

                <!-- Bootcamp Name and Fees -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-form.input
                        type="text"
                        name="name"
                        label="اسم البوتكامب"
                        placeholder="أدخل اسم البوتكامب"
                        :value="old('name', $bootcamp->name)"
                        inputClass="sm:text-sm"
                        required
                        error="{{ $errors->first('name') }}" />

                    <x-form.input
                        type="text"
                        name="fees"
                        label="الرسوم (بالريال السعودي)"
                        placeholder="أدخل الرسوم"
                        :value="old('fees', $bootcamp->fees)"
                        inputClass="sm:text-sm"
                        required
                        error="{{ $errors->first('fees') }}" />
                </div>

                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="الوصف"
                    placeholder="أدخل وصفًا مختصرًا للبوتكامب"
                    value="{{ old('description', $bootcamp->description) }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm"
                    error="{{ $errors->first('description') }}" />

                <!-- Features and Instructor -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-form.textarea
                        name="features"
                        label="المميزات (ميزة في كل سطر)"
                        placeholder="أدخل المميزات، ميزة في كل سطر"
                        value="{{ old('features', $bootcamp->features) }}"
                        rows="4"
                        required
                        inputClass="sm:text-sm"
                        error="{{ $errors->first('features') }}" />

                    <x-form.input
                        type="text"
                        name="instructor"
                        label="اسم المدرب"
                        placeholder="أدخل اسم المدرب"
                        :value="old('instructor', $bootcamp->instructor)"
                        inputClass="sm:text-sm"
                        required
                        error="{{ $errors->first('instructor') }}" />
                </div>

                <!-- Training Duration -->
                <x-form.input
                    type="number"
                    name="training_duration"
                    label="مدة التدريب (بالأسابيع)"
                    placeholder="أدخل مدة التدريب"
                    :value="old('training_duration', $bootcamp->training_duration)"
                    inputClass="sm:text-sm"
                    required
                    error="{{ $errors->first('training_duration') }}" />

                <!-- Main Image -->
                <div>
                    <x-form.file
                        name="main_image"
                        label="الصورة الرئيسية"
                        :existingImage="Storage::url($bootcamp->main_image)"
                        error="{{ $errors->first('main_image') }}" />
                    @if ($bootcamp->main_image)
                        <div class="mt-4">
                            <label class="text-sm">الصورة الحالية:</label>
                            <img src="{{ Storage::url($bootcamp->main_image) }}" alt="Current Main Image" class="mt-2 w-32 h-32 object-cover rounded-md" />
                        </div>
                    @endif
                </div>

                <!-- Additional Images -->
                <div>
                    <x-form.file
                        name="additional_images[]"
                        label="صور إضافية"
                        multiple
                        :existingImages="is_array($bootcamp->additional_images) ? array_map(fn($image) => Storage::url($image), $bootcamp->additional_images) : []"
                        error="{{ $errors->first('additional_images.*') }}" />
                    @if ($bootcamp->additional_images)
                        <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach ($bootcamp->additional_images as $image)
                                <div>
                                    <img src="{{ Storage::url($image) }}" alt="Additional Image" class="w-32 h-32 object-cover rounded-md" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>
    </x-common.content-container>
</x-layout>
