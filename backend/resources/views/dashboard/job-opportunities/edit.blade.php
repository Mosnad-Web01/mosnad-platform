<x-layout title="Edit Job Opportunity">

    <x-common.header title="تعديل فرصة العمل" />

    <x-common.content-container title="معلومات الفرصة">

        <form action="{{ route('job-opportunities.update', $jobOpportunity->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-4 p-4">
            @csrf
            @method('PUT')

            <!-- Row 1: Image Upload and Title -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start ">
                <!-- Title -->
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">اسم الفرصة</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $jobOpportunity->title) }}"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-2">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Image Upload -->
                <div>
                    <label for="imgurl" class="block mb-2 text-sm font-medium text-gray-900">صورة إعلان</label>
                    <input type="file" id="imgurl" name="imgurl"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-1">
                    @if ($jobOpportunity->imgurl)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $jobOpportunity->imgurl) }}" alt="Image"
                                class="w-24 h-24 object-cover">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Row 2: Description -->
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">الوصف</label>
                <textarea id="description" name="description" rows="4"
                    class="block w-full border border-gray-300 rounded-lg text-sm p-2">{{ old('description', $jobOpportunity->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <!-- Row 3: Required Skills and Experience -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Position Level -->
                <div>
                    <label for="position_level" class="block mb-2 text-sm font-medium text-gray-900">المستوى
                        الوظيفي</label>
                    <select id="position_level" name="position_level"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-2">
                        <option value="" selected>اختر المستوى</option>
                        <option value="مستوى مبتدئ" {{ old('position_level', $jobOpportunity->position_level) == 'مستوى مبتدئ' ? 'selected' : '' }}>مستوى مبتدئ</option>
                        <option value="مستوى متوسط" {{ old('position_level', $jobOpportunity->position_level) == 'مستوى متوسط' ? 'selected' : '' }}>مستوى متوسط</option>
                        <option value="مستوى خبير" {{ old('position_level', $jobOpportunity->position_level) == 'مستوى خبير' ? 'selected' : '' }}>مستوى خبير</option>
                    </select>
                    @error('position_level')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Experience -->
                <div>
                    <label for="experience" class="block mb-2 text-sm font-medium text-gray-900">مستوى الخبرة</label>
                    <select id="experience" name="experience"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-2">
                        <option value="" selected>اختر مستوى الخبرة</option>
                        <option value="سنة - سنتين" {{ old('experience', $jobOpportunity->experience) == 'سنة - سنتين' ? 'selected' : '' }}>سنة - سنتين</option>
                        <option value="3-5 سنوات" {{ old('experience', $jobOpportunity->experience) == '3-5 سنوات' ? 'selected' : '' }}>3-5 سنوات</option>
                        <option value="5+ سنوات" {{ old('experience', $jobOpportunity->experience) == '5+ سنوات' ? 'selected' : '' }}>5+ سنوات</option>
                    </select>
                    @error('experience')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 4: Required Skills and Other Criteria -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="required_skills" class="block mb-2 text-sm font-medium text-gray-900">المهارات
                        التقنية</label>
                    <input type="text" id="required_skills" name="required_skills"
                        value="{{ old('required_skills', $jobOpportunity->required_skills) }}"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-2">
                    @error('required_skills')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- End Date -->
                <div>
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">تاريخ انتهاء
                        الفرصة</label>
                    <input type="date" id="end_date" name="end_date"
                        value="{{ old('end_date') ? date('Y-m-d', strtotime(old('end_date'))) : '' }}"
                        class="block w-full border border-gray-300 rounded-lg text-sm p-2">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div>
                <label for="other_criteria" class="block mb-2 text-sm font-medium text-gray-900">معايير أخرى</label>
                <textarea id="other_criteria" name="other_criteria" rows="4"
                    class="block w-full border border-gray-300 rounded-lg text-sm p-2">{{ old('other_criteria', $jobOpportunity->other_criteria) }}</textarea>
                @error('other_criteria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="w-full md:w-1/2 bg-gradient-to-r from-purple-950 via-purple-800 to-blue-600 hover:bg-gradient-to-r hover:from-purple-800 hover:via-purple-600 hover:to-blue-400 text-white font-medium rounded-lg py-3 shadow-md">
                    تحديث
                </button>
            </div>

        </form>

    </x-common.content-container>

</x-layout>