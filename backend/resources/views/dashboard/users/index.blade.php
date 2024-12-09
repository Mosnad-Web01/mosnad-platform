<x-layout title="Users Management">
    <x-common.header title="إدارة المستخدمين" :showBackButton="true" />

    <x-common.content-container title="إدارة المستخدمين">
        <!-- Search and Filter Component -->
        {!! view()->make('components.common.search-filter', ['roles' => $roles]) !!}

        <!-- Active Users Table -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white mb-8">
            <h2 class="px-6 py-4 text-lg font-semibold text-gray-700">المستخدمين النشطين</h2>
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الاسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">البريد الإلكتروني</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">رقم الهاتف</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الدور</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الحالة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">التاريخ</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $user)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $user->id }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm">
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ Str::limit($user->email, 20) }}</a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ Str::limit($user->phone_number, 20) }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $user->role->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->status == 'active' ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm">
                                @if ($user->role->name !== 'admin')
                                <form action="{{ route('users.update-status', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm font-medium {{ $user->status == 'active' ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }} hover:underline">
                                        {{ $user->status == 'active' ? 'تعطيل' : 'تفعيل' }}
                                    </button>
                                </form>
                                @else
                                <span class="text-gray-400 text-sm font-medium">لا إجراءات</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-600">لا يوجد مستخدمين</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-common.pagination :items="$users" />
            </div>
        </div>

        <!-- Suspended Users Table -->
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <h2 class="px-6 py-4 text-lg font-semibold text-gray-700">المستخدمين الموقوفين</h2>
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الاسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">البريد الإلكتروني</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الدور</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">الحالة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($suspendedUsers as $user)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $user->id }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm">
                                <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ Str::limit($user->email, 20) }}</a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $user->role->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->status == 'suspended' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->status == 'suspended' ? 'موقوف' : 'نشط' }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm">{{ $user->created_at->format('Y-m-d H:i') }}</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-600">لا يوجد مستخدمين موقوفين</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <x-common.pagination :items="$suspendedUsers" />

            </div>
        </div>
    </x-common.content-container>
</x-layout>