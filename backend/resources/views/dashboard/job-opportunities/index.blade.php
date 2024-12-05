<x-layout title="Manage Job Opportunities">

    <x-common.header title="إدارة الفرص" />

    <x-common.content-container title="جدول الاستبانات">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm font-medium sm:font-bold">ID</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm font-medium sm:font-bold">اسم الفرصة</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm font-medium sm:font-bold">حالة الفرصة</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm font-medium sm:font-bold">المتقدمين</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm font-medium sm:font-bold">action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($jobOpportunities as $jobOpportunity)
                            <tr class="transition-colors hover:bg-gray-50">
                                <td class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-sm text-gray-700">
                                    {{ $jobOpportunity->id }}
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-4 text-center text-xs sm:text-base font-light sm:font-medium text-gray-900">
                                    <a href="{{ route('job-opportunities.show', $jobOpportunity->id) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $jobOpportunity->title }}
                                    </a>
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                                    <span class="px-2 sm:px-3 py-0.5 sm:py-1 text-xs sm:text-sm font-light sm:font-medium text-green-600 bg-green-100 rounded-full">
                                        متاحة
                                    </span>
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                                    <a href="#"
                                        class="px-2 sm:px-4 py-0.5 sm:py-1 text-xs sm:text-sm font-light sm:font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full">
                                         المتقدمين ({{ $jobOpportunity->applicants_count ?? "0" }})
                                    </a>
                                </td>
                                <td class="px-2 sm:px-4 py-2 sm:py-4 text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        <!-- Edit Icon -->
                                        <a href="{{ route('job-opportunities.edit', $jobOpportunity->id) }}"
                                            class="text-green-600 hover:text-green-800 hover:scale-110 transition duration-300 text-xs sm:text-sm">
                                            <i class="material-icons">edit</i>
                                        </a>

                                        <!-- Delete Icon -->
                                        <form action="{{ route('job-opportunities.destroy', $jobOpportunity->id) }}"
                                            method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفرصة؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-700 hover:scale-110 transition duration-300 text-xs sm:text-sm">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Empty State -->
        @if($jobOpportunities->isEmpty())
            <div class="text-center py-6 sm:py-12">
                <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-xs sm:text-sm font-light sm:font-medium text-gray-900">لا توجد بيانات</h3>
            </div>
        @endif

        <x-common.pagination :items="$jobOpportunities" />
    </x-common.content-container>

</x-layout>
