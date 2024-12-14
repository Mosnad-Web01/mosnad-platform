<x-layout title="Users Management">
    <x-common.header title="إدارة المستخدمين" :showBackButton="true" />

    <x-common.content-container>
        <!-- Search and Filter Component -->
        {!! view()->make('components.common.search-filter', ['roles' => $roles]) !!}

        <!-- Active Users Table -->
        <h2 class="px-6 py-4 text-lg font-semibold text-gray-700">المستخدمين النشطين</h2>
            <x-table
                :headers="['الرقم', 'الاسم', 'البريد الإلكتروني', 'رقم الهاتف', 'الدور', 'الحالة', 'التاريخ', 'الإجراءات']"
                :items="$users"
                :hasActions="false"
            >
                @foreach ($users as $user)
                    <tr class="transition-colors hover:bg-gray-50">
                        <!-- ID -->
                        <x-table.cell>
                            {{ $user->id }}
                        </x-table.cell>

                        <!-- Name -->
                        <x-table.cell>
                            {{ $user->name }}
                        </x-table.cell>

                        <!-- Email -->
                        <x-table.cell>
                            <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                {{ Str::limit($user->email, 20) }}
                            </a>
                        </x-table.cell>

                        <!-- Phone -->
                        <x-table.cell>
                            {{ Str::limit($user->phone_number, 20) }}
                        </x-table.cell>

                        <!-- Role -->
                        <x-table.cell>
                            {{ $user->role->name }}
                        </x-table.cell>

                        <!-- Status -->
                        <x-table.cell>
                            <x-table.badge
                                :type="$user->status == 'active' ? 'success' : 'danger'"
                                :text="$user->status == 'active' ? 'نشط' : 'غير نشط'"
                            />
                        </x-table.cell>

                        <!-- Date -->
                        <x-table.cell>
                            {{ $user->created_at->format('Y-m-d H:i') }}
                        </x-table.cell>

                        <!-- Actions -->
                        <x-table.cell>
                            @if ($user->role->name !== 'admin')
                                <form action="{{ route('users.update-status', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="text-sm font-medium {{ $user->status == 'active' ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }} hover:underline">
                                        {{ $user->status == 'active' ? 'تعطيل' : 'تفعيل' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-sm font-medium">لا إجراءات</span>
                            @endif
                        </x-table.cell>
                    </tr>
                @endforeach
            </x-table>

            <h2 class="px-6 py-4 text-lg font-semibold text-gray-700 mt-10">المستخدمين الموقوفين</h2>
            <x-table
                :headers="['الرقم', 'الاسم', 'البريد الإلكتروني', 'الدور', 'الحالة', 'التاريخ']"
                :items="$suspendedUsers"
                :hasActions="false"
                headerClass="bg-gray-700"
            >
                @foreach ($suspendedUsers as $user)
                    <tr class="transition-colors hover:bg-gray-50">
                        <!-- ID -->
                        <x-table.cell>
                            {{ $user->id }}
                        </x-table.cell>

                        <!-- Name -->
                        <x-table.cell>
                            {{ $user->name }}
                        </x-table.cell>

                        <!-- Email -->
                        <x-table.cell>
                            <a href="mailto:{{ $user->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                {{ Str::limit($user->email, 20) }}
                            </a>
                        </x-table.cell>

                        <!-- Role -->
                        <x-table.cell>
                            {{ $user->role->name }}
                        </x-table.cell>

                        <!-- Status -->
                        <x-table.cell>
                            <x-table.badge
                                type="danger"
                                text="موقوف"
                            />
                        </x-table.cell>

                        <!-- Date -->
                        <x-table.cell>
                            {{ $user->created_at->format('Y-m-d H:i') }}
                        </x-table.cell>
                    </tr>
                @endforeach
            </x-table>
    </x-common.content-container>
</x-layout>
