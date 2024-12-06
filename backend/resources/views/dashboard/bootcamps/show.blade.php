<x-layout title="Bootcamp Details">
    <x-common.header title="تفاصيل المعسكر التدريبي" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-10">

            <!-- General Information -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المعلومات العامة</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <p><span class="text-gray-600">اسم المعسكر:</span> <span class="font-medium text-gray-900">{{ $bootcamp->name }}</span></p>
                    <p><span class="text-gray-600">المدينة:</span> <span class="font-medium text-gray-900">{{ $bootcamp->city }}</span></p>
                    <p><span class="text-gray-600">المدة التدريبية:</span> <span class="font-medium text-gray-900">{{ $bootcamp->training_duration }} أسابيع</span></p>
                    <p><span class="text-gray-600">المدرب:</span> <span class="font-medium text-gray-900">{{ $bootcamp->instructor }}</span></p>
                </div>
            </div>

            <!-- Description -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">الوصف</h2>
                <p class="text-sm text-gray-900 leading-relaxed">{{ $bootcamp->description }}</p>
            </div>

            <!-- Features -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المميزات</h2>
                <ul class="list-disc pl-6 text-sm text-gray-900 space-y-2">
                    @foreach(explode("\n", $bootcamp->features) as $feature)
                    <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Fees and Payment Terms -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">التكلفة وشروط الدفع</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <p><span class="text-gray-600">التكلفة:</span> <span class="font-medium text-gray-900">{{ number_format($bootcamp->fees, 2) }} ريال</span></p>
                    <p><span class="text-gray-600">شروط الدفع:</span>
                        <span class="font-medium text-gray-900">{{ $bootcamp->payment_terms ?? 'غير متوفر' }}</span>
                    </p>
                </div>
            </div>

            <!-- Images -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">الصور</h2>
                <div class="space-y-4">
                    @if($bootcamp->main_image)
                    <div>
                        <h3 class="text-base font-bold text-gray-800">الصورة الرئيسية:</h3>
                        <img src="{{ asset('storage/' . $bootcamp->main_image) }}" alt="Main Image" class="w-full h-auto rounded-md border border-gray-300 shadow-sm">
                    </div>
                    @endif

                    @if($bootcamp->additional_images)
                    <div>
                        <h3 class="text-base font-bold text-gray-800">صور إضافية:</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach(is_array($bootcamp->additional_images) ? $bootcamp->additional_images : json_decode($bootcamp->additional_images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Additional Image" class="w-full h-auto rounded-md border border-gray-300 shadow-sm">
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Edit Button -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('bootcamps.edit', $bootcamp->id) }}"
                    class="px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    تعديل
                </a>
            </div>

        </div>
    </x-common.content-container>
</x-layout>