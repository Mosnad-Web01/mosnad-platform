<x-layout title="Users Management">
    <x-common.header title="إدارة المستخدمين" :showBackButton="true" />

    <x-common.content-container title="جدول المستخدمين">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الاسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">البريد الإلكتروني</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">رقم الهاتف</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الدور</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الحالة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">التاريخ</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $user->id }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ Str::limit($user->email, 20) }}</a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ Str::limit($user->phone_number, 20) }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $user->role->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                @if($user->status == 'active')
                                <span class="inline-flex bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">نشط</span>
                                @else
                                <span class="inline-flex bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">غير نشط</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <span class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <!-- Toggle User Status -->
                                @if($user->role_id !== 1) <!-- Do not show for Admin -->
                                <form action="{{ route('users.update-status', $user->id) }}" method="POST" class="inline ml-4">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm font-medium 
                                        {{ $user->status == 'active' ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }} hover:underline">
                                        {{ $user->status == 'active' ? 'تعطيل' : 'تفعيل' }}
                                    </button>

                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <x-common.pagination :items="$users" />

        <!-- Empty State -->
        @if($users->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">لا يوجد مستخدمين</h3>
        </div>
        @endif
    </x-common.content-container>
</x-layout>