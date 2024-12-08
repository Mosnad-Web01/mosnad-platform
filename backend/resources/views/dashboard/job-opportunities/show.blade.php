<x-layout title="Show Job Opportunity">
    <!-- Header Section -->
    <x-common.header title="عرض الفرصة" :showBackButton="true" />
    <!-- Main Content Container -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Job Title Card -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h3 class="text-lg font-semibold text-indigo-900 mb-3">اسم الفرصة</h3>
                <p class="text-gray-700 text-lg">{{ $jobOpportunity->title ?? 'غير متوفر' }}</p>
            </div>

            <!-- End Date Card -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h3 class="text-lg font-semibold text-indigo-900 mb-3">تاريخ الانتهاء</h3>
                <p class="text-gray-700 text-lg">
                    {{ $jobOpportunity->end_date ? $jobOpportunity->end_date->format('Y-m-d') : 'غير متوفر' }}
                </p>
            </div>

            <!-- Status Card -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h3 class="text-lg font-semibold text-indigo-900 mb-3">الحالة</h3>
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                    <span
                        class="w-2 h-2 rounded-full {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'bg-green-600' : 'bg-red-600' }} mr-2"></span>
                    {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'متاحة' : 'منتهية' }}
                </span>
            </div>
        

        <!-- Nested Content Grid -->
            <!-- Description Section -->
            <div class=" bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <h3 class="text-lg font-semibold text-indigo-900 mb-3">الوصف</h3>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $jobOpportunity->description ?? 'غير متوفر' }}</p>
            </div>

            <!-- Required Skills Section -->
            <div class=" bg-gray-50 rounded-lg p-4 hover:shadow-md transition">
                <h3 class="text-lg font-semibold text-indigo-900 mb-3">المهارات المطلوبة</h3>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $jobOpportunity->required_skills ?? 'غير متوفر' }}</p>
            </div>

            <!-- Job Image Section -->
            @if ($jobOpportunity->imgurl)
                <div >
                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <h3 class="text-lg font-semibold text-indigo-900 mb-3">صورة الفرصة</h3>
                        <div class="relative rounded-xl overflow-hidden shadow-lg">
                            @php
                                $isUrl = Str::startsWith($jobOpportunity->imgurl, ['http://', 'https://']);
                            @endphp
                            <img src="{{ $isUrl ? $jobOpportunity->imgurl : asset('storage/' . $jobOpportunity->imgurl) }}"
                                alt="Job Image" class="w-full h-auto object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</x-layout>
