<x-layout title="Bootcamp Details">
    <x-common.header title="تفاصيل المعسكر التدريبي" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">

            <!-- General Information -->
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المعلومات العامة</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-base">
                    <p><span class="text-gray-600">اسم المعسكر:</span> <span class="font-medium text-gray-900">{{ $bootcamp->name }}</span></p>
                    <p><span class="text-gray-600">المدينة:</span> <span class="font-medium text-gray-900">{{ $bootcamp->city }}</span></p>
                    <p><span class="text-gray-600">المدة التدريبية:</span> <span class="font-medium text-gray-900">{{ $bootcamp->training_duration }} أسابيع</span></p>
                    <p><span class="text-gray-600">المدرب:</span> <span class="font-medium text-gray-900">{{ $bootcamp->instructor }}</span></p>
                </div>
            </div>

            <!-- Description -->
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">الوصف</h2>
                <p class="text-base text-gray-900 leading-relaxed">{{ $bootcamp->description }}</p>
            </div>

            <!-- Features -->
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المميزات</h2>
                <ul class="list-disc pl-5 text-base text-gray-900 space-y-2">
                    @foreach(explode("\n", $bootcamp->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Fees and Payment Terms -->
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">التكلفة وشروط الدفع</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-base">
                    <p><span class="text-gray-600">التكلفة:</span> <span class="font-medium text-gray-900">{{ number_format($bootcamp->fees, 2) }} ريال</span></p>
                    <p><span class="text-gray-600">شروط الدفع:</span> 
                        <span class="font-medium text-gray-900">{{ $bootcamp->payment_terms ?? 'غير متوفر' }}</span>
                    </p>
                </div>
            </div>

            <!-- Images -->
            <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">الصور</h2>
                <div class="space-y-4">
                    @if($bootcamp->main_image)
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">الصورة الرئيسية:</h3>
                            <img src="{{ asset('storage/' . $bootcamp->main_image) }}" alt="Main Image" class="w-full h-auto rounded-md border border-gray-300 shadow-sm">
                        </div>
                    @else
                        <div class="flex items-center text-gray-500 text-base">
                            <x-heroicon-o-photograph class="w-5 h-5 mr-2" /> لا توجد صورة رئيسية متوفرة.
                        </div>
                    @endif

                    @if($bootcamp->additional_images && count(json_decode($bootcamp->additional_images)) > 0)
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">صور إضافية:</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach(json_decode($bootcamp->additional_images) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Additional Image" class="w-full h-auto rounded-md border border-gray-300 shadow-sm">
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="flex items-center text-gray-500 text-base">
                            <x-heroicon-o-photograph class="w-5 h-5 mr-2" /> لا توجد صور إضافية متوفرة.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </x-common.content-container>
</x-layout>
