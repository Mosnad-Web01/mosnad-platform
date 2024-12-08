<x-layout title="تفاصيل المعسكر التدريبي">
    <!-- Header Section -->
    <x-common.header title="تفاصيل المعسكر التدريبي" :showBackButton="true" />
    
    <!-- Main Content Container -->
    <x-common.content-container title="تفاصيل المعسكر التدريبي">
        <!-- General Information and Description -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المعلومات العامة</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">اسم المعسكر:</span> <span class="font-medium text-gray-900">{{ $bootcamp->name }}</span></p>
                    <p><span class="text-gray-600">المدينة:</span> <span class="font-medium text-gray-900">{{ $bootcamp->city }}</span></p>
                    <p><span class="text-gray-600">المدة التدريبية:</span> <span class="font-medium text-gray-900">{{ $bootcamp->training_duration }} أسابيع</span></p>
                    <p><span class="text-gray-600">المدرب:</span> <span class="font-medium text-gray-900">{{ $bootcamp->instructor }}</span></p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">الوصف</h2>
                <p class="text-sm text-gray-900">{{ $bootcamp->description }}</p>
            </div>
        </div>

        <!-- Features and Fees -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المميزات</h2>
                <ul class="list-disc pl-8 text-sm text-gray-900 space-y-2">
                    @foreach(explode("\n", $bootcamp->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">التكلفة وشروط الدفع</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">التكلفة:</span> <span class="font-medium text-gray-900">{{ number_format($bootcamp->fees, 2) }} ريال</span></p>
                    <p><span class="text-gray-600">شروط الدفع:</span> <span class="font-medium text-gray-900">{{ $bootcamp->payment_terms ?? 'غير متوفر' }}</span></p>
                </div>
            </div>
        </div>

        <!-- Images Section -->
        <div class="bg-gray-50 rounded-2xl shadow-lg p-6 border border-gray-100 mb-6">
            <h2 class="text-2xl font-bold text-indigo-800 mb-6 border-b pb-3">معرض الصور</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Main Image Section -->
                <div class="col-span-1 lg:col-span-2">
                    @if ($bootcamp->main_image)
                        @php
                            $isUrl = Str::startsWith($bootcamp->main_image, ['http://', 'https://']);
                        @endphp
                        <div class="relative group">
                            <img src="{{ $isUrl ? $bootcamp->main_image : Storage::url($bootcamp->main_image) }}" 
                                 alt="الصورة الرئيسية" 
                                 class="w-full h-64 object-contain rounded-xl shadow-md">
                            <p class="text-sm text-gray-600 text-center mt-3">الصورة الرئيسية</p>
                        </div>
                    @else
                        <div class="h-64 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500">
                            لا توجد صورة رئيسية
                        </div>
                    @endif
                </div>

                <!-- Additional Images Section -->
                @if($bootcamp->additional_images && count($bootcamp->additional_images))
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($bootcamp->additional_images as $image)
                            @php
                                $isUrl = Str::startsWith($image, ['http://', 'https://']);
                            @endphp
                            <div class="relative group">
                                <img src="{{ $isUrl ? $image : Storage::url($image) }}" 
                                     alt="صورة إضافية" 
                                     class="w-full h-32 object-cover rounded-lg shadow-md">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-span-1 lg:col-span-3 bg-gray-100 rounded-xl flex items-center justify-center text-gray-500 h-32">
                        لا توجد صور إضافية
                    </div>
                @endif
            </div>
        </div>

        <!-- Edit Button -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('bootcamps.edit', $bootcamp->id) }}" 
               class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition duration-200">
                تعديل
            </a>
        </div>
    </x-common.content-container>
</x-layout>
