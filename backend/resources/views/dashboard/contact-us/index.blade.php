<x-layout title="Contact Us Messages">
    <x-common.header title="تواصل معنا" :showBackButton="true" />

    <x-common.content-container title="جدول الرسائل">
        <!-- Table Component -->
        <x-table
            :headers="['الرقم', 'الاسم', 'البريد الإلكتروني', 'رقم الهاتف', 'الرسالة', 'التاريخ']"
            :items="$contactUsMessages"
            :hasActions="false"
        >
            @foreach ($contactUsMessages as $message)
                <tr class="transition-colors hover:bg-gray-50">
                    <!-- Message ID -->
                    <x-table.cell>{{ $message->id }}</x-table.cell>

                    <!-- Name -->
                    <x-table.cell>
                        <a href="{{ route('dashboard.contact-us.show', $message->id) }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ Str::limit($message->name, 20) }}
                        </a>
                    </x-table.cell>

                    <!-- Email -->
                    <x-table.cell>
                        <a href="mailto:{{ $message->email }}"
                           class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ Str::limit($message->email, 20) }}
                        </a>
                    </x-table.cell>

                    <!-- Phone -->
                    <x-table.cell>{{ Str::limit($message->phone, 20) }}</x-table.cell>

                    <!-- Message Content -->
                    <x-table.cell>{{ Str::limit($message->message, 20) }}</x-table.cell>

                    <!-- Created Date -->
                    <x-table.cell>
                        <span class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $message->created_at->format('Y-m-d H:i') }}
                        </span>
                    </x-table.cell>
                </tr>
            @endforeach
        </x-table>
    </x-common.content-container>
</x-layout>
