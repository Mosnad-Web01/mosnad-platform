<!-- resources/views/dashboard/contact-us/show.blade.php -->

<x-layout title="عرض الرسالة">
    <!-- Header Section -->
    <x-common.header title="عرض الرسالة" :showBackButton="true" />
    <!-- Main Content Container -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <!-- User Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 pb-6">
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4  pb-2">تفاصيل المستخدم</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">الإسم:</span> <span class="font-medium text-gray-900">{{ $message->name }}</span></p>
                    <p><span class="text-gray-600">رقم الهاتف:</span> <span class="font-medium text-gray-900">{{ $message->phone ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">البريد الإلكتروني:</span> <span class="font-medium text-gray-900">{{ $message->email ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">تاريخ الرسالة:</span> <span class="font-medium text-gray-900">{{ $message->created_at->format('Y-m-d H:i') }}</span></p>
                    <p><span class="text-gray-600">عدد الردود:</span> <span class="font-medium text-gray-900">{{ $message->replies->count() }}</span></p>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4  pb-2">إرسال رد</h2>
                <form method="POST" action="{{ route('contact-us.reply', $message->id) }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="reply" class="block text-sm font-medium text-gray-700 mb-2">نص الرد</label>
                        <textarea id="reply" name="reply" rows="6" class="w-full p-3 bg-white resize-none border-gray-300 rounded-lg shadow-sm" required></textarea>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition duration-200 ease-in-out">
                        إرسال
                    </button>
                </form>
            </div>
        </div>

        <!-- Message Text -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4  pb-2">نص الرسالة</h2>
            <p class="text-sm text-gray-900">{{ $message->message }}</p>
        </div>

        <!-- Replies List -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4  pb-2">الردود</h2>
            <div class="space-y-4 text-sm">
                @forelse ($message->replies as $reply)
                <div class="border-b pb-4">
                    <p><strong class="text-gray-800">الرد:</strong> <span class="font-medium text-gray-900">{{ $reply->reply }}</span></p>
                    <p><span class="text-gray-600">التاريخ:</span> <span class="font-medium text-gray-900">{{ $reply->created_at->format('Y-m-d H:i') }}</span></p>
                </div>
                @empty
                <p class="text-gray-600">لا توجد ردود بعد.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
