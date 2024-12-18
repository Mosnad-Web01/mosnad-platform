<x-layout title="Blog Details">
    <div class="max-w-5xl mx-auto my-12">
        <!-- Glassmorphism Container -->
        <div class="p-1 rounded-2xl bg-gradient-to-br from-indigo-600/30 via-purple-600/30 to-pink-600/30 ">
            <div class="bg-white/90 rounded-2xl shadow-2xl overflow-hidden">
                <div class="relative ">

                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/10 to-purple-600/10"></div>
                    <div class="px-8 py-6 flex flex-col md:flex-row justify-between items-center relative z-10">

                        <!-- Title Section -->
                        <div class="mr-4 ">
                            <div class="relative">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg blur opacity-25">
                                </div>

                                <h2
                                    class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-900 to-purple-900">
                                    {{ $blog->title }}
                                </h2>
                            </div>
                            <p class="text-gray-500 mt-2">{{ $blog->created_at->format('M d, Y') }}</p>
                        </div>



                        <!-- Author Card with Hover Effects -->
                        <div class="flex items-center space-x-4 bg-white/50 p-4 rounded-xl border border-white/20 "
                            dir="ltr">
                            <div
                                class="w-[70px] h-[70px] rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 flex items-center justify-center text-white ">
                                <span class="text-2xl font-bold">{{ substr($blog->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-indigo-900">{{ $blog->user->name }}</h2>
                                <p class="text-gray-600">{{ $blog->user->email }}</p>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="px-8 py-6 space-y-8">
                    <!-- Content Card -->
                    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-clipboard-list ml-3 text-indigo-600"></i>
                            محتوى المقالة
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $blog->content }}</p>
                    </div>


                    <!-- Enhanced Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" dir="rtl">
                        <!-- Categories -->
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-folder ml-2 text-indigo-600"></i>
                                التصنيف
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($blog->categories) as $category)
                                    <span
                                        class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-200 cursor-pointer">
                                        {{ $category }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-toggle-on ml-2 text-indigo-600"></i>
                                الحالة
                            </h3>
                            <span class="px-6 py-2 text-sm font-semibold rounded-full inline-block cursor-pointer
                                {{ $blog->status === 'published' ? 'bg-gradient-to-r from-green-400 to-green-600' : 'bg-gradient-to-r from-yellow-400 to-yellow-600' }}
                                text-white shadow-sm ">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </div>

                        <!-- Creation Date -->
                        <div class="bg-white p-6 rounded-xl shadow-lg  border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-calendar ml-2 text-indigo-600"></i>
                                تاريخ الإنشاء
                            </h3>
                            <p class="text-gray-700 font-medium">
                                {{ $blog->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <!-- Tags -->
                        <div class="bg-white p-6 rounded-xl shadow-lg  border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-hashtag ml-2 text-indigo-600"></i>
                                التاغات
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($blog->tags) as $tag)
                                    <span
                                        class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-purple-200 transition-colors cursor-pointer">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Image Carousel -->
                    @if($blog->images)
                                    <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-lg">
                                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-images ml-2 text-indigo-600"></i>
                                            الصور
                                        </h3>
                                        <div class="flex gap-4 overflow-x-auto pb-4 ">
                                            @foreach(json_decode($blog->images) as $image)
                                                                    <div class="flex-none w-full md:w-1/2 lg:w-1/3 relative ">
                                                                        <div class="relative overflow-hidden rounded-lg">

                                                                            @php
                                                                                $images = json_decode($blog->images);
                                                                                $imagePath = $images[0];
                                                                            @endphp

                                                                            @if(filter_var($imagePath, FILTER_VALIDATE_URL))
                                                                                <!-- If the image path is an external URL -->

                                                                                <img src="{{ $image }}" alt="Blog image" loading="lazy"
                                                                                    class="w-full h-64 object-cover rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                                                                            @else
                                                                                <!-- If the image path is a local file path -->
                                                                                <img src="{{ asset('storage/' . $image) }}" alt="Blog image" loading="lazy"
                                                                                    class="w-full h-64 object-cover rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                    @endif

                    <!-- Enhanced Meta Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" dir="rtl">
                        <!-- Meta Title -->
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-info-circle ml-2 text-indigo-600"></i>
                                عنوان ( Meta )
                            </h3>
                            <p class="text-gray-700">{{ $blog->meta_title }}</p>
                        </div>

                        <!-- Meta Description -->
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 ">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-align-left ml-2 text-indigo-600"></i>
                                وصف ( Meta )
                            </h3>
                            <p class="text-gray-700">{{ $blog->meta_description }}</p>
                        </div>

                        <!-- Meta Keywords -->
                        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 md:col-span-2">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-key ml-2 text-indigo-600"></i>
                                كلمات مفتاحية ( Meta )
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($blog->meta_keywords) as $keyword)
                                    <span
                                        class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 cursor-pointer">
                                        {{ $keyword }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        @can('update-blog', $blog)
                            <x-table.action-buttons :editUrl="route('blogs.edit', $blog->id)"
                                :deleteUrl="route('blogs.destroy', $blog->id)"
                                deleteConfirmMessage="هل أنت متأكد من حذف هذه المدونة ؟" :hasDeleteButton="true"
                                isBigButton="true" />
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>