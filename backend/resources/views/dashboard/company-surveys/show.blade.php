<x-layout title="Company Form Details">
    <x-common.header title="عرض استمارة الشركة" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-10">

            <!-- General Information -->
            <div class="p-6 bg-white rounded-lg">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المعلومات العامة</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <p><span class="text-gray-600">الإسم:</span> <span class="font-medium text-gray-900">{{ $companyForm->name }}</span></p>
                    <p><span class="text-gray-600">البريد الإلكتروني:</span> <span class="font-medium text-gray-900">{{ $companyForm->email }}</span></p>
                    <p><span class="text-gray-600">القطاع:</span> <span class="font-medium text-gray-900">{{ $companyForm->industry ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">عدد الموظفين:</span> <span class="font-medium text-gray-900">{{ $companyForm->employees ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">المرحلة:</span> <span class="font-medium text-gray-900">{{ $companyForm->stage ?? 'غير متوفر' }}</span></p>
                </div>
            </div>

            <!-- Hiring & Training Information -->
            <div class="p-6 bg-white rounded-lg">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المعلومات الخاصة بالتوظيف والتدريب</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <p><span class="text-gray-600">التوظيف:</span> <span class="font-medium text-gray-900">{{ $companyForm->hiring }}</span></p>
                    <p><span class="text-gray-600">هل توفر تدريب؟:</span> <span class="font-medium text-gray-900">{{ $companyForm->training ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">العمالة عن بعد:</span> <span class="font-medium text-gray-900">{{ $companyForm->home_workers ?? 'غير متوفر' }}</span></p>
                </div>
            </div>

            <!-- Skills & Remote Hiring Preferences -->
            <div class="p-6 bg-white rounded-lg">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">المهارات وتفضيلات التوظيف عن بعد</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">المهارات المطلوبة:</span> 
                        <span class="font-medium text-gray-900">
                            @if($companyForm->skills)
                                {{ implode(', ', json_decode($companyForm->skills)) }}
                            @else
                                غير متوفر
                            @endif
                        </span>
                    </p>
                    <p><span class="text-gray-600">تفضيلات التوظيف عن بعد:</span> 
                        <span class="font-medium text-gray-900">
                            @if($companyForm->remote_hiring_preferences)
                                {{ implode(', ', json_decode($companyForm->remote_hiring_preferences)) }}
                            @else
                                غير متوفر
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <!-- Additional Notes -->
            <div class="p-6 bg-white rounded-lg">
                <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">ملاحظات إضافية</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">ملاحظات إضافية:</span> 
                        <span class="font-medium text-gray-900">{{ $companyForm->additional_notes ?? 'غير متوفر' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </x-common.content-container>
</x-layout>
