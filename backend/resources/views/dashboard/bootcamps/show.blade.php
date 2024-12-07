<x-layout title="Bootcamp Details">
    <x-common.header title="تفاصيل المعسكر التدريبي" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-10">

            <!-- General Information -->
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">المعلومات العامة</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                    <p><span class="text-gray-600">اسم المعسكر:</span> <span class="font-medium text-gray-900">{{ $bootcamp->name }}</span></p>
                    <p><span class="text-gray-600">المدينة:</span> <span class="font-medium text-gray-900">{{ $bootcamp->city }}</span></p>
                    <p><span class="text-gray-600">المدة التدريبية:</span> <span class="font-medium text-gray-900">{{ $bootcamp->training_duration }} أسابيع</span></p>
                    <p><span class="text-gray-600">المدرب:</span> <span class="font-medium text-gray-900">{{ $bootcamp->instructor }}</span></p>
                </div>
            </div>

            <!-- Description -->
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">الوصف</h2>
                <p class="text-base text-gray-900 leading-relaxed">{{ $bootcamp->description }}</p>
            </div>

            <!-- Features -->
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">المميزات</h2>
                <ul class="list-disc pl-8 text-base text-gray-900 space-y-2">
                    @foreach(explode("\n", $bootcamp->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Fees and Payment Terms -->
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">التكلفة وشروط الدفع</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                    <p><span class="text-gray-600">التكلفة:</span> <span class="font-medium text-gray-900">{{ number_format($bootcamp->fees, 2) }} ريال</span></p>
                    <p><span class="text-gray-600">شروط الدفع:</span> <span class="font-medium text-gray-900">{{ $bootcamp->payment_terms ?? 'غير متوفر' }}</span></p>
                </div>
            </div>

            <!-- Images -->
            <div class="p-8 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b-2 border-blue-500 pb-2">الصور</h2>
                <div class="space-y-6">

                    <!-- Main Image -->
                    @if ($bootcamp->main_image)
                        @php
                            $isUrl = Str::startsWith($bootcamp->main_image, ['http://', 'https://']);
                        @endphp
                        <img src="{{ $isUrl ? $bootcamp->main_image : Storage::url($bootcamp->main_image) }}"
                            alt="Main Image" class="w-64 h-64 object-cover rounded-lg">
                    @else
                        <p>الصورة الرئيسية غير متوفرة</p>
                    @endif

                    <!-- Additional Images -->
                    @if($bootcamp->additional_images && count($bootcamp->additional_images))
                        <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @foreach ($bootcamp->additional_images as $image)
                                @php
                                    $isUrl = Str::startsWith($image, ['http://', 'https://']);
                                @endphp
                                <img src="{{ $isUrl ? $image : Storage::url($image) }}"
                                    alt="Additional Image" class="w-32 h-32 object-cover rounded-md">
                            @endforeach
                        </div>
                    @else
                        <p>صور إضافية غير متوفرة</p>
                    @endif
                </div>
            </div>

            <!-- Edit Button -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('bootcamps.edit', $bootcamp->id) }}"
                    class="px-6 py-3 text-sm font-bold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    تعديل
                </a>
            </div>

        </div>
    </x-common.content-container>
</x-layout>
