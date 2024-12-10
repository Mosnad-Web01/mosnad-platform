<x-layout title="Youth Surveys">
    <x-common.header title="استبانات الشباب" :showBackButton="true" />

    <!-- Search Component -->
    {!! view()->make('components.common.search-filter', ['roles' => $roles ?? []]) !!}

    <x-common.content-container title="جدول الاستبانات">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                الإسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                المدينة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                العنوان</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                تاريخ الميلاد</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">
                                أرقام التواصل</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($youthForms as $form)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->id }}</td>
                                <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                    <!-- Link to the detailed page -->
                                    <a href="{{ route('youth-surveys.show', $form->id) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $form->user_name }}
                                    </a>
                                </td>
                                <!-- Fetch city, address, and birth date from user profile -->
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->city ?? 'N/A' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->address ?? 'N/A' }}</td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $form->birth_date ? \Carbon\Carbon::parse($form->birth_date)->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->phone_number ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-common.pagination :items="$youthForms" />
        
        <!-- Empty State -->
        @if($youthForms->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد بيانات</h3>
            </div>
        @endif
    </x-common.content-container>

</x-layout>
