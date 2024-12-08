<x-layout title="Company Surveys">
    <x-common.header title="استبانات الشركات" :showBackButton="true" />

    <x-common.content-container title="جدول الاستبانات">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الإسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الايميل</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الصناعة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">عدد الموظفين التقريبي</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">مرحلة البدء</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($companyForms as $form)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->id }}</td>


                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <!-- Link to the detailed page -->
                                <a href="{{ route('company-surveys.show', $form->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $form->name }}
                                </a>
                            </td>

                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <a href="mailto:{{ $form->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ $form->email }}</a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->industry }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->employees }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $form->hiring }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm whitespace-nowrap">
                                <span class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $form->created_at->format('Y-m-d H:i') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <x-common.pagination :items="$companyForms" />


        <!-- Empty State -->
        @if($companyForms->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد بيانات</h3>
        </div>
        @endif
    </x-common.content-container>
</x-layout>