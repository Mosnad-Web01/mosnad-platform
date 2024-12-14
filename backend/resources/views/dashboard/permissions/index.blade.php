
<x-layout title="Permissions">
    <x-common.header title="الصلاحيات" :showBackButton="true" />

    <!-- Permissions Content -->
    <x-common.content-container title="جدول الصلاحيات">
       
        <!-- Table Component -->
        <x-table
        :headers="['#', 'الاسم', 'الوصف', 'تاريخ الإنشاء' ]"
        :items="$permissions"
        :hasActions="true"
        :withPagination="false"
            >
            @foreach ($permissions as $permission)
                <tr class="transition-colors hover:bg-gray-50">
                    <!-- ID -->
                    <x-table.cell>{{ $permission->id }}</x-table.cell>

                    <!-- Name -->
                    <x-table.cell>{{ $permission->name }}</x-table.cell>

                    <!-- Description -->
                    <x-table.cell>{{ $permission->description }}</x-table.cell>

                    <!-- Created At -->
                    <x-table.cell>{{ $permission->created_at }}</x-table.cell>

                    <!-- Actions -->
                    <x-table.cell>
                        <x-table.action-buttons :editUrl="route('permissions.edit', $permission->id)"
                            :hasDeleteButton="false" />
                    </x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
