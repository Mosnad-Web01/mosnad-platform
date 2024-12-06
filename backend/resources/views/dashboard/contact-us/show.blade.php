<x-layout title="عرض الرسالة">
    <x-common.header title="تفاصيل الرسالة" :showBackButton="true" />

    <x-common.content-container>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 ">
            <!-- User Information -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">تفاصيل المستخدم</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">الإسم:</span> <span class="font-medium text-gray-900">{{ $message->name }}</span></p>
                    <p><span class="text-gray-600">رقم الهاتف:</span> <span class="font-medium text-gray-900">{{ $message->phone ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">البريد الإلكتروني:</span> <span class="font-medium text-gray-900">{{ $message->email ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">تاريخ الرسالة:</span> <span class="font-medium text-gray-900">{{ $message->created_at->format('Y-m-d H:i') }}</span></p>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">إرسال رد</h2>
                <form class="space-y-6">
                    @csrf
                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-2">نص الرد</label>
                        <textarea id="body" name="body" rows="6" class="w-full p-3 bg-gray-50 resize-none border-gray-300 rounded-lg shadow-sm " required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                        إرسال
                    </button>
                </form>
            </div>
        </div>


        <div class="mt-2 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">نص الرسالة</h2>
            <div class="space-y-4 text-sm">
                <p><span class="text-gray-800 font-bold">الرسالة:</span> <span class="font-medium text-gray-900">{{ $message->message }}</span></p>
            </div>
        </div>
    </x-common.content-container>
</x-layout>
