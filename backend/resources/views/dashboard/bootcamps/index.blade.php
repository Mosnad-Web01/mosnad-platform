<!-- /resources/views/dashboard/bootcamps/index.blade.php -->
<x-layout title="Bootcamps">
    <x-common.header title="الدورات التدريبية" :showBackButton="true" />

    <x-common.content-container title="جدول الدورات التدريبية">
        <x-table :headers="['الرقم', 'الاسم', 'المدرب', 'المدينة', 'الرسوم', 'المدة']" :items="$bootcamps"
            :hasActions="true">
            @foreach ($bootcamps as $bootcamp)
                <tr class="transition-colors hover:bg-gray-50">

                    <!-- Bootcamp ID -->
                    <x-table.cell>
                        {{ $bootcamp->id }}
                    </x-table.cell>

                    <!-- Bootcamp Name -->
                    <x-table.cell>
                        <a href="{{ route('bootcamps.show', $bootcamp->id) }}"
                            class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $bootcamp->name }}
                        </a>
                    </x-table.cell>

                    <!-- Bootcamp Instructor -->
                    <x-table.cell>
                        {{ $bootcamp->instructor }}
                    </x-table.cell>

                    <!-- Bootcamp City -->
                    <x-table.cell>
                        {{ $bootcamp->city }}
                    </x-table.cell>

                    <!-- Bootcamp Fees -->
                    <x-table.cell>
                        {{ $bootcamp->fees }}$
                    </x-table.cell>

                    <!-- Bootcamp Training Duration -->
                    <x-table.cell>
                        {{ $bootcamp->training_duration }} أسابيع
                    </x-table.cell>

                    <!-- Action Buttons -->
                    <x-table.cell>
                        <x-table.action-buttons
                            :editUrl="route('bootcamps.edit', $bootcamp->id)"
                            :deleteUrl="route('bootcamps.destroy', $bootcamp->id)"
                            deleteConfirmMessage="هل أنت متأكد من حذف هذا المخيم التدريبي؟"
                            :hasDeleteButton="true"
                         />
                    </x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
