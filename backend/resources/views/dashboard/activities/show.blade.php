<x-layout title="Show Activity">
    <x-common.header title="تفاصيل النشاط" :showBackButton="true" />

    <x-common.content-container>
        <div class="max-w-full mx-auto">
            <!-- Activity Header Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                    <h1 class="text-2xl font-bold text-white">{{ $activity->title }}</h1>
                    <div class="flex items-center mt-4 space-x-4 space-x-reverse">
                        <span class="inline-flex items-center px-3 py-1 gap-2 rounded-full text-sm font-medium {{ $activity->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            <span class="w-2 h-2 mr-2 rounded-full {{ $activity->status == 'published' ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                            {{ $activity->status == 'published' ? 'نشط' : 'مسودة' }}
                        </span>
                        <span class="text-blue-100 flex items-center">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $activity->activity_date->format('Y-m-d H:i') }}
                        </span>
                        <span class="text-blue-100 flex items-center">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $activity->location }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Description Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            وصف النشاط
                        </h2>
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            {{ $activity->description }}
                        </div>
                    </div>

                    <!-- Images Gallery -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 ml-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            معرض الصور
                        </h2>

                        @if($activity->images && is_array($activity->images))
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($activity->images as $image)
                            <div class="group relative aspect-square rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                                <img
                                    src="{{ asset('storage/' . $image) }}"
                                    alt="Activity Image"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-xl p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500 text-lg">لا توجد صور للنشاط</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">إجراءات سريعة</h3>
                        <div class="space-y-3">
                            <a
                                href="{{ route('activities.edit', $activity->id) }}"
                                class="flex items-center justify-center w-full px-4 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-300 font-medium">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                تعديل النشاط
                            </a>
                            <!-- Delete Activity Form -->
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا النشاط؟');">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="flex items-center justify-center w-full px-4 py-3 border border-red-600 text-red-600 rounded-xl hover:bg-red-50 transition-colors duration-300 font-medium">
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    حذف النشاط
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Info Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">معلومات إضافية</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-gray-600">تاريخ الإنشاء</span>
                                <span class="text-gray-800">{{ $activity->created_at->format('Y-m-d') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">معرف النشاط</span>
                                <span class="text-gray-800">#{{ $activity->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-common.content-container>
</x-layout>