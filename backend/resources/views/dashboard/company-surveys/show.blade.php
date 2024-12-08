<x-layout title="عرض استمارة الشركة">
    <!-- Header Section -->
    <x-common.header title="عرض استمارة الشركة" :showBackButton="true" />
    
    <!-- Main Content Container -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <!-- General Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 pb-6">
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المعلومات العامة</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">الإسم:</span> <span class="font-medium text-gray-900">{{ $companyForm->name }}</span></p>
                    <p><span class="text-gray-600">البريد الإلكتروني:</span> <span class="font-medium text-gray-900">{{ $companyForm->email }}</span></p>
                    <p><span class="text-gray-600">القطاع:</span> <span class="font-medium text-gray-900">{{ $companyForm->industry ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">عدد الموظفين:</span> <span class="font-medium text-gray-900">{{ $companyForm->employees ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">المرحلة:</span> <span class="font-medium text-gray-900">{{ $companyForm->stage ?? 'غير متوفر' }}</span></p>
                </div>
            </div>

            <!-- Hiring & Training Information -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المعلومات الخاصة بالتوظيف والتدريب</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">التوظيف:</span> <span class="font-medium text-gray-900">{{ $companyForm->hiring }}</span></p>
                    <p><span class="text-gray-600">هل توفر تدريب؟:</span> <span class="font-medium text-gray-900">{{ $companyForm->training ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">العمالة عن بعد:</span> <span class="font-medium text-gray-900">{{ $companyForm->home_workers ?? 'غير متوفر' }}</span></p>
                </div>
            </div>
        </div>

        <!-- Skills & Remote Hiring Preferences -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المهارات وتفضيلات التوظيف عن بعد</h2>
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
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">ملاحظات إضافية</h2>
            <p class="text-sm text-gray-900">{{ $companyForm->additional_notes ?? 'غير متوفر' }}</p>
        </div>
    </div>
</x-layout>
