<x-layout title="Show Job Opportunity">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-900 to-indigo-800 p-6 rounded-lg mb-6 shadow-lg">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gradient-to-r from-indigo-300 to-indigo-800">عرض فرصة العمل</h1>
            <a href="{{ route('job-opportunities.index') }}" class="text-white hover:text-indigo-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">

        <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">

        <div class="flex items-center">
                <h2 class="text-xl font-bold text-indigo-900 flex items-center gap-2">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    معلومات الفرصة
                </h2>
            </div>


                <div class="flex items-center space-x-2">
                    <a href="{{ route('job-opportunities.edit', $jobOpportunity) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition duration-300 ease-in-out ">
                        <span class="material-icons">edit</span>
                    </a>
                    <form action="{{ route('job-opportunities.destroy', $jobOpportunity) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition duration-300 ease-in-out">
                            <span class="material-icons">delete</span>
                        </button>
                    </form>
                </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Job Title Card -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-900">اسم الفرصة</h3>
                </div>
                <p class="text-gray-700 text-lg">{{ $jobOpportunity->title ?? 'غير متوفر' }}</p>
            </div>

            <!-- End Date Card  -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-900">تاريخ الانتهاء</h3>
                </div>
                <p class="text-gray-700 text-lg">
                    {{ $jobOpportunity->end_date ? $jobOpportunity->end_date->format('Y-m-d') : 'غير متوفر' }}
                </p>
            </div>

            <!-- Status Card -->
            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-900">الحالة</h3>
                </div>
                <span
                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                    <span
                        class="w-2 h-2 rounded-full {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'bg-green-600' : 'bg-red-600' }} mr-2"></span>
                    {{ $jobOpportunity->end_date && $jobOpportunity->end_date > now() ? 'متاحة' : 'منتهية' }}
                </span>
            </div>

            <!-- Description Section -->
            <div
                class="col-span-full bg-gray-50 rounded-lg p-6 hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-indigo-900">الوصف</h3>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $jobOpportunity->description ?? 'غير متوفر' }}</p>
            </div>
            <!-- Required Skills Section -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-gray-50 rounded-lg p-4 hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-4">
                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-indigo-900">المهارات المطلوبة</h3>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $jobOpportunity->required_skills ?? 'غير متوفر' }}
                </p>
            </div>

            <!-- Job Image Section -->
            @if ($jobOpportunity->imgurl)
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <div class="relative rounded-xl overflow-hidden shadow-lg">
                                @php
                                    $isUrl = Str::startsWith($jobOpportunity->imgurl, ['http://', 'https://']);
                                @endphp
                                <img src="{{ $isUrl ? $jobOpportunity->imgurl : asset('storage/' . $jobOpportunity->imgurl) }}"
                                    alt="Job Image" class="w-full h-auto object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            </div>
                        </div>
            @endif

            <!-- Action Buttons -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 flex justify-start space-x-4 mt-6">
                <a href="{{ route('job-opportunities.index') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-1">
                    رجوع إلى قائمة الفرص
                </a>
            </div>
        </div>
    </div>
</x-layout>
