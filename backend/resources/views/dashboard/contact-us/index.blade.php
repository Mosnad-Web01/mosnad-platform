<x-layout title="Contact Us Messages">
    <x-common.header title="تواصل معنا" :showBackButton="true" />

    <x-common.content-container title="جدول الرسائل">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الاسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">البريد الإلكتروني</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">رقم الهاتف</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرسالة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($contactUsMessages as $message)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $message->id }}</td>

                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <a href="{{ route('dashboard.contact-us.show', $message->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ Str::limit($message->name, 20) }}
                                </a>
                            </td>


                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ Str::limit($message->email, 20) }}</a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ Str::limit($message->phone, 20) }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ Str::limit($message->message, 20) }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <span class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <x-common.pagination :items="$contactUsMessages" />

        <!-- Empty State -->
        @if($contactUsMessages->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد رسائل</h3>
        </div>
        @endif
    </x-common.content-container>
</x-layout>