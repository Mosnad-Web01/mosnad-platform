<x-layout title="Show Activity">
    <x-common.header title="تفاصيل النشاط" :showBackButton="true" />

    <x-common.content-container title="تفاصيل النشاط">
        <div class="space-y-6">
            <!-- Activity Title -->
            <div class="flex flex-col">
                <label for="title" class="text-sm font-medium text-gray-700">اسم النشاط</label>
                <p class="mt-1 p-2 border rounded-md bg-gray-100">{{ $activity->title }}</p>
            </div>

            <!-- Activity Description -->
            <div class="flex flex-col">
                <label for="description" class="text-sm font-medium text-gray-700">وصف النشاط</label>
                <p class="mt-1 p-2 border rounded-md bg-gray-100">{{ $activity->description }}</p>
            </div>

            <!-- Activity Date -->
            <div class="flex flex-col">
                <label for="activity_date" class="text-sm font-medium text-gray-700">تاريخ النشاط</label>
                <p class="mt-1 p-2 border rounded-md bg-gray-100">{{ $activity->activity_date->format('Y-m-d H:i') }}</p>
            </div>

            <!-- Activity Location -->
            <div class="flex flex-col">
                <label for="location" class="text-sm font-medium text-gray-700">الموقع</label>
                <p class="mt-1 p-2 border rounded-md bg-gray-100">{{ $activity->location }}</p>
            </div>

            <!-- Activity Images -->
            <div class="flex flex-col">
                <label for="images" class="text-sm font-medium text-gray-700">صور النشاط</label>
                <div class="mt-4">
                    @if($activity->images)
                        @foreach(json_decode($activity->images, true) as $image)
                            <div class="inline-block relative mr-2 mb-2">
                                <img src="{{ asset('storage/' . $image) }}" alt="Activity Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endforeach
                    @else
                        <p class="mt-1 text-gray-500">لا توجد صور للنشاط</p>
                    @endif
                </div>
            </div>

            <!-- Activity Status -->
            <div class="flex flex-col">
                <label for="status" class="text-sm font-medium text-gray-700">الحالة</label>
                <p class="mt-1 p-2 border rounded-md bg-gray-100">
                    @if($activity->status == 'published')
                        نشط
                    @else
                        مسودة
                    @endif
                </p>
            </div>

            <!-- Edit Button -->
            <div>
                <a href="{{ route('activities.edit', $activity->id) }}" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-center block">تعديل النشاط</a>
            </div>
        </div>
    </x-common.content-container>
</x-layout>
