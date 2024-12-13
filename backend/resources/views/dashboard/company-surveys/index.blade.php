<x-layout title="Company Surveys">
    <x-common.header title="استبانات الشركات" :showBackButton="true" />

    <x-common.content-container title="جدول الاستبانات">
        <!-- Table Component -->
        <x-table
        :headers="['الرقم', 'الإسم', 'الايميل', 'الصناعة', 'عدد الموظفين التقريبي', 'مرحلة البدء', 'التاريخ']"
            :items="$companyForms"
            :hasActions="false">
            @foreach ($companyForms as $form)
                <tr class="transition-colors hover:bg-gray-50">
                    <!-- Form ID -->
                    <x-table.cell>{{ $form->id }}</x-table.cell>

                    <!-- Form Name -->
                    <x-table.cell>
                        <a href="{{ route('company-surveys.show', $form->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $form->name }}
                        </a>
                    </x-table.cell>

                    <!-- Form Email -->
                    <x-table.cell>
                        <a href="mailto:{{ $form->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $form->email }}
                        </a>
                    </x-table.cell>

                    <!-- Industry -->
                    <x-table.cell>{{ $form->industry }}</x-table.cell>

                    <!-- Number of Employees -->
                    <x-table.cell>{{ $form->employees }}</x-table.cell>

                    <!-- Hiring Stage -->
                    <x-table.cell>{{ $form->hiring }}</x-table.cell>

                    <!-- Creation Date -->
                    <x-table.cell>
                        <span class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $form->created_at->format('Y-m-d H:i') }}
                        </span>
                    </x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
