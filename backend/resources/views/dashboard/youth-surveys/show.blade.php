<x-layout title="عرض استمارة الشباب">
    <x-common.header title="عرض استمارة الشباب" :showBackButton="true" />

    <!-- Main Content Container -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <!-- General Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-200 pb-6">
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المعلومات العامة</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">الإسم:</span> <span class="font-medium text-gray-900">{{ $youthForm->user_name }}</span></p>
                    <p><span class="text-gray-600">المدينة:</span> <span class="font-medium text-gray-900">{{ $youthForm->city ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">تاريخ الميلاد:</span>
                        <span class="font-medium text-gray-900">
                            {{ $youthForm->birth_date ? \Carbon\Carbon::parse($youthForm->birth_date)->format('Y-m-d') : 'غير متوفر' }}
                        </span>
                    </p>
                    <p><span class="text-gray-600">العنوان:</span> <span class="font-medium text-gray-900">{{ $youthForm->address ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">رقم الهاتف:</span> <span class="font-medium text-gray-900">{{ $youthForm->phone_number ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">الجنس:</span> <span class="font-medium text-gray-900">{{ $youthForm->gender ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">هل خريج تقنية المعلومات؟:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->is_it_graduate ? 'نعم' : 'لا' }}</span>
                    </p>
                    <p><span class="text-gray-600">الإهتمام الوظيفي:</span> <span class="font-medium text-gray-900">{{ $youthForm->job_interest ?? 'غير متوفر' }}</span></p>
                </div>
            </div>

            <!-- Academic & Professional Information -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">المعلومات الأكاديمية والمهنية</h2>
                <div class="space-y-4 text-sm">
                    <p><span class="text-gray-600">الدوافع للتعلم:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->motivation ?? 'غير متوفر' }}</span>
                    </p>
                    <p><span class="text-gray-600">أهداف العمل المهني:</span> <span class="font-medium text-gray-900">{{ $youthForm->career_goals ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">أفكار المشاريع:</span> <span class="font-medium text-gray-900">{{ $youthForm->project_ideas ?? 'غير متوفر' }}</span></p>
                    <p><span class="text-gray-600">هل حضر ورش عمل؟:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->has_workshops ? 'نعم' : 'لا' }}</span>
                    </p>
                    <p><span class="text-gray-600">توضيح ورش العمل:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->workshop_clarify ?? 'غير متوفر' }}</span>
                    </p>
                    <p><span class="text-gray-600">هل لديه خبرة في البرمجة؟:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->has_coding_experience ? 'نعم' : 'لا' }}</span>
                    </p>
                    <p><span class="text-gray-600">توضيح الخبرة البرمجية:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->coding_clarify ?? 'غير متوفر' }}</span>
                    </p>
                    <p><span class="text-gray-600">هل يعرف لغات برمجة أخرى؟:</span>
                        <span class="font-medium text-gray-900">{{ $youthForm->knows_other_languages ? 'نعم' : 'لا' }}</span>
                    </p>
                    <p>
                        <span class="text-gray-600">لغات البرمجة:</span>
                        <span class="font-medium text-gray-900">
                            @if ($youthForm->languages)
                          
                            {{ $youthForm->languages }},
                          
                            @else
                            غير متوفر
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Technical Insights -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">رؤى تقنية</h2>
            <div class="space-y-4 text-sm">
                <p><span class="text-gray-600">حل المشكلات بطريقة إبداعية:</span>
                    <span class="font-medium text-gray-900">{{ $youthForm->creative_problem_solving ?? 'غير متوفر' }}</span>
                </p>
                <p><span class="text-gray-600">الفرق بين موقع الويب وتطبيق الويب:</span>
                    <span class="font-medium text-gray-900">{{ $youthForm->website_vs_webapp ?? 'غير متوفر' }}</span>
                </p>
                <p><span class="text-gray-600">الخطوات لضمان سهولة الإستخدام:</span>
                    <span class="font-medium text-gray-900">{{ $youthForm->usability_steps ?? 'غير متوفر' }}</span>
                </p>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
            <h2 class="text-xl font-bold text-indigo-900 mb-4 pb-2">معلومات إضافية</h2>
            <div class="space-y-4 text-sm">
                <p><span class="text-gray-600">المزيد من المعلومات:</span>
                    <span class="font-medium text-gray-900">{{ $youthForm->additional_info ?? 'غير متوفر' }}</span>
                </p>
                @if($youthForm->document)
                <div>
                    <h3 class="text-base font-bold text-gray-800 mb-4">عرض المستند:</h3>
                    <iframe
                        src="{{ asset('storage/' . $youthForm->document) }}"
                        class="w-full h-[500px] rounded-md border border-gray-300 shadow-sm"
                        frameborder="0">
                        المستند غير مدعوم في متصفحك.
                    </iframe>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>