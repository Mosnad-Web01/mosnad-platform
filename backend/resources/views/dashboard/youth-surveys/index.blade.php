<x-layout title="Youth Surveys">
    <x-common.header title="استبانات الشباب" :showBackButton="true" />

    <!-- Search Component -->
    {!! view()->make('components.common.search-filter', ['roles' => $roles ?? []]) !!}

    <x-common.content-container title="جدول الاستبانات">
        <!-- Table Component -->
        <x-table
            :headers="['الرقم', 'الإسم', 'المدينة', 'العنوان', 'تاريخ الميلاد', 'أرقام التواصل']"
            :items="$youthForms"
            :hasActions="false"
            :items="$youthForms"
        >
            @foreach ($youthForms as $form)
                <tr class="transition-colors hover:bg-gray-50">
                    <!-- Form ID -->
                    <x-table.cell>{{ $form->id }}</x-table.cell>

                    <!-- Form Name -->
                    <x-table.cell>
                        <a href="{{ route('youth-surveys.show', $form->id) }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $form->user->name }}
                        </a>
                    </x-table.cell>

                    <!-- City -->
                    <x-table.cell>{{ $form->city }}</x-table.cell>

                    <!-- Address -->
                    <x-table.cell>{{ $form->address }}</x-table.cell>

                    <!-- Birth Date -->
                    <x-table.cell>
                        {{ $form->birth_date ? \Carbon\Carbon::parse($form->birth_date)->format('Y-m-d') : 'N/A' }}
                    </x-table.cell>

                    <!-- Phone Number -->
                    <x-table.cell>{{ $form->phone_number }}</x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
