<!-- resources/views/dashboard/youth-surveys/show.blade.php -->

<x-layout title="Survey Details">
    <x-common.header title="تفاصيل الاستبانة" />

    <x-common.content-container title="تفاصيل الاستبانة">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold text-gray-800 mb-4">معلومات الاستبانة</h2>
            
            <div class="mb-4">
                <p class="font-medium text-gray-700">الإسم: <span class="text-gray-900">{{ $youthForm->name }}</span></p>
                <p class="font-medium text-gray-700">الإيميل: <span class="text-gray-900">{{ $youthForm->email }}</span></p>
                <p class="font-medium text-gray-700">تاريخ الميلاد: <span class="text-gray-900">{{ $youthForm->birth_date }}</span></p>
                <p class="font-medium text-gray-700">المدينة: <span class="text-gray-900">{{ $youthForm->city }}</span></p>
                <p class="font-medium text-gray-700">العنوان: <span class="text-gray-900">{{ $youthForm->address }}</span></p>
                <p class="font-medium text-gray-700">رقم الهاتف: <span class="text-gray-900">{{ $youthForm->phone }}</span></p>
                <p class="font-medium text-gray-700">المزيد من المعلومات: <span class="text-gray-900">{{ $youthForm->additional_info }}</span></p>
            </div>

            <!-- Add other fields as needed -->
        </div>
    </x-common.content-container>
</x-layout>
