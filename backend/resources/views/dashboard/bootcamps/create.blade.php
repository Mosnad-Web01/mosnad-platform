<x-layout title="إنشاء معسكر تدريبي">
    <x-common.header title="إنشاء معسكر تدريبي جديد" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">
            <!-- Create Bootcamp Form -->
            <form action="{{ route('bootcamps.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-lg space-y-6">
                @csrf

                <!-- Row: Bootcamp Name & City -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-form.input
                        type="text"
                        name="name"
                        label="اسم المعسكر التدريبي"
                        placeholder="أدخل اسم المعسكر التدريبي"
                        :value="old('name')"
                        inputClass="sm:text-sm"
                        required />

                    <x-form.input
                        type="text"
                        name="city"
                        label="المدينة"
                        placeholder="أدخل المدينة"
                        :value="old('city')"
                        inputClass="sm:text-sm"
                        required />
                </div>

                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="الوصف"
                    placeholder="أدخل وصفًا مختصرًا عن المعسكر التدريبي"
                    value="{{ old('description') }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm" />

                <!-- Features -->
                <x-form.textarea
                    name="features"
                    label="المميزات (كل ميزة في سطر)"
                    placeholder="أدخل المميزات، كل ميزة في سطر"
                    value="{{ old('features') }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm" />

                <!-- Row: Fees & Instructor -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-form.input
                        type="number"
                        name="fees"
                        label="التكلفة (بالريال السعودي)"
                        placeholder="أدخل التكلفة"
                        :value="old('fees')"
                        inputClass="sm:text-sm"
                        required />

                    <x-form.input
                        type="text"
                        name="instructor"
                        label="المدرب"
                        placeholder="أدخل اسم المدرب"
                        :value="old('instructor')"
                        inputClass="sm:text-sm"
                        required />
                </div>

                <!-- Training Duration -->
                <x-form.input
                    type="number"
                    name="training_duration"
                    label="مدة التدريب (بالأسابيع)"
                    placeholder="أدخل مدة التدريب"
                    :value="old('training_duration')"
                    inputClass="sm:text-sm"
                    required />

                <!-- Main Image -->
                <x-form.file
                    name="main_image"
                    label="الصورة الرئيسية (مطلوبة)"
                    help="قم بتحميل الصورة الرئيسية للمعسكر التدريبي. يسمح فقط بصيغ jpeg, png, jpg, gif, svg."
                    required />

                <!-- Additional Images -->
                <x-form.file
                    name="additional_images[]"
                    label="صور إضافية"
                    help="قم بتحميل صور إضافية (اختياري). يمكنك تحميل عدة صور."
                    multiple />

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        إنشاء معسكر تدريبي
                    </button>
                </div>
            </form>
        </div>
    </x-common.content-container>
</x-layout>
