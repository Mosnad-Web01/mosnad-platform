<x-layout title="Create Bootcamp">
    <x-common.header title="Create New Bootcamp" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">
            <!-- Create Bootcamp Form -->
            <form action="{{ route('bootcamps.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-lg space-y-6">
                @csrf

                <!-- Row: Bootcamp Name & City -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-form.input
                        type="text"
                        name="name"
                        label="Bootcamp Name"
                        placeholder="Enter Bootcamp Name"
                        :value="old('name')"
                        inputClass="sm:text-sm"
                        required />

                    <x-form.input
                        type="text"
                        name="city"
                        label="City"
                        placeholder="Enter City"
                        :value="old('city')"
                        inputClass="sm:text-sm"
                        required />
                </div>

                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Description"
                    placeholder="Enter a short description of the bootcamp"
                    value="{{ old('description') }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm" />

                <!-- Features -->
                <x-form.textarea
                    name="features"
                    label="Features (One per line)"
                    placeholder="Enter the features, one per line"
                    value="{{ old('features') }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm" />

                <!-- Row: Fees & Instructor -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <x-form.input
                        type="number"
                        name="fees"
                        label="Fees (in SAR)"
                        placeholder="Enter fees"
                        :value="old('fees')"
                        inputClass="sm:text-sm"
                        required />

                    <x-form.input
                        type="text"
                        name="instructor"
                        label="Instructor"
                        placeholder="Enter instructor name"
                        :value="old('instructor')"
                        inputClass="sm:text-sm"
                        required />
                </div>

                <!-- Training Duration -->
                <x-form.input
                    type="number"
                    name="training_duration"
                    label="Training Duration (in weeks)"
                    placeholder="Enter training duration"
                    :value="old('training_duration')"
                    inputClass="sm:text-sm"
                    required />

                <!-- Main Image -->
                <x-form.file
                    name="main_image"
                    label="Main Image (Required)"
                    help="Upload the main image for the bootcamp. Only jpeg, png, jpg, gif, svg formats are allowed."
                    required />

                <!-- Additional Images -->
                <x-form.file
                    name="additional_images[]"
                    label="Additional Images"
                    help="Upload additional images (optional). You can upload multiple images."
                    multiple />

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Bootcamp
                    </button>
                </div>
            </form>
        </div>
    </x-common.content-container>
</x-layout>
