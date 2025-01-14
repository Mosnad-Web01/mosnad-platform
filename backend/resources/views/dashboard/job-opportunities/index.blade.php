<!-- /resources/views/dashboard/job-opportunities/index.blade.php -->
<x-layout title="إدارة الفرص">
    <x-common.header title="إدارة الفرص" :showBackButton="true" />

    <x-common.content-container title="جدول الفرص">
        <x-table
        :headers="['ID', 'اسم الفرصة', 'حالة الفرصة', 'تاريخ الانتهاء', 'عدد المتقدمين', 'تأكيد النشر']"
        :items="$jobOpportunities"
        :hasActions="true"
         >
            @foreach ($jobOpportunities as $jobOpportunity)
                <tr class="transition-colors hover:bg-gray-50">

                    <!-- Job Opportunity ID -->
                    <x-table.cell>
                        {{ $jobOpportunity->id }}
                    </x-table.cell>

                    <!-- Job Opportunity Title -->
                    <x-table.cell>
                        <a href="{{ route('job-opportunities.show', $jobOpportunity->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $jobOpportunity->title }}
                        </a>
                    </x-table.cell>

                    <!-- Job Opportunity Status -->
                    <x-table.cell>
                        @if (now()->greaterThan($jobOpportunity->end_date))
                            <x-table.badge type="danger" text="منتهية" />
                        @else
                            <x-table.badge type="success" text="متاحة" />
                        @endif
                    </x-table.cell>

                    <!-- Job Opportunity End Date -->
                    <x-table.cell>
                        {{ $jobOpportunity->end_date->format('Y-m-d') }}
                    </x-table.cell>

                    <!-- Applicants Count -->
                    <x-table.cell>
                        <a href="#"
                            class="px-2 sm:px-4 py-0.5 sm:py-1 text-xs sm:text-sm font-light sm:font-medium lg:text-white lg:bg-blue-600 hover:bg-blue-700 rounded-full">
                            ({{ $jobOpportunity->applicants_count ?? "0" }})
                        </a>
                    </x-table.cell>

                    <!-- Toggle Approval Button -->
<x-table.cell>
    <form action="{{ route('job-opportunities.toggle-approval', $jobOpportunity->id) }}" method="POST">
        @csrf
        @method('POST')
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-white 
            {{ $jobOpportunity->is_approved ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} 
            rounded-full">
            {{ $jobOpportunity->is_approved ? 'موافق' : 'غير موافق' }}
        </button>
    </form>
</x-table.cell>

                    <!-- Action Buttons -->
                    <x-table.cell>
                        <x-table.action-buttons
                            :editUrl="route('job-opportunities.edit', $jobOpportunity->id)"
                            :deleteUrl="route('job-opportunities.destroy', $jobOpportunity->id)"
                            deleteConfirmMessage="هل أنت متأكد من حذف هذه الفرصة؟"
                            :hasDeleteButton="true"
                            />
                    </x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
