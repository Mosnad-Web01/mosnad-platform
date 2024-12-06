<x-layout title="Edit Bootcamp">
    <x-common.header title="Edit Bootcamp - {{ $bootcamp->name }}" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">

            <!-- Edit Bootcamp Form -->
            <form action="{{ route('dashboard.bootcamps.update', $bootcamp->id) }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-lg">
                @csrf
                @method('PUT')

                <!-- Bootcamp Name -->
                <x-form.input
                    type="text"
                    name="name"
                    label="Bootcamp Name"
                    placeholder="Enter Bootcamp Name"
                    :value="old('name', $bootcamp->name)"
                    inputClass="sm:text-sm"
                    required
                />

                <!-- Description -->
                <x-form.textarea
                    name="description"
                    label="Description"
                    placeholder="Enter a short description of the bootcamp"
                    value="{{ old('description', $bootcamp->description) }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm"
                />

                <!-- Features -->
                <x-form.textarea
                    name="features"
                    label="Features (One per line)"
                    placeholder="Enter the features, one per line"
                    value="{{ old('features', $bootcamp->features) }}"
                    rows="4"
                    required
                    inputClass="sm:text-sm"
                />

                <!-- Fees -->
                <x-form.input
                    type="number"
                    name="fees"
                    label="Fees (in SAR)"
                    value="{{ old('fees', $bootcamp->fees) }}"
                    required
                    inputClass="sm:text-sm"
                />

                <!-- Instructor -->
                <x-form.input
                    type="text"
                    name="instructor"
                    label="Instructor"
                    value="{{ old('instructor', $bootcamp->instructor) }}"
                    required
                    inputClass="sm:text-sm"
                />

                <!-- Training Duration -->
                <x-form.input
                    type="number"
                    name="training_duration"
                    label="Training Duration (in weeks)"
                    value="{{ old('training_duration', $bootcamp->training_duration) }}"
                    required
                    inputClass="sm:text-sm"
                />

                <!-- Main Image -->
                <x-form.file
                    name="main_image"
                    label="Main Image"
                    :existingImage="Storage::url($bootcamp->main_image)"
                    required
                />

                <!-- Additional Images -->
                <x-form.file
                    name="additional_images[]"
                    label="Additional Images"
                    multiple
                    :existingImages="array_map(fn($image) => Storage::url($image), $bootcamp->additional_images)"
                />

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </x-common.content-container>
</x-layout>
