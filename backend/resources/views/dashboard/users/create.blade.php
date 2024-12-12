<x-layout title="Create User">
    <x-common.header title="Create New User" :showBackButton="true" />

    <x-common.content-container>
        <div class="space-y-6">
            <!-- Create User Form -->
            <form action="{{ route('users.store') }}" method="POST" class="p-8 bg-white rounded-lg shadow-lg space-y-6">
                @csrf

                <!-- Row: User Name & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">User Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Enter User Name"
                            class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Enter Email Address"
                            class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Row: Phone Number & Role -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Enter Phone Number"
                            class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                            value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role Select -->
                    <!-- Replace Role Select with Admin Types Multiple Select -->
                    <div class="space-y-2">
                        <label for="admin_types" class="block text-sm font-medium text-gray-700">
                            Admin Types <span class="text-red-500">*</span>
                        </label>
                        <select name="admin_types[]" id="admin_types"
                            class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                            multiple required>
                            @foreach ($adminTypes as $adminType)
                                <option value="{{ $adminType->id }}" {{ in_array($adminType->id, old('admin_types', [])) ? 'selected' : '' }}>
                                    {{ $adminType->name }}
                                    ( الصلاحيات : {{ $adminType->permissions->pluck('name')->join(', ') }})
                                </option>
                            @endforeach
                        </select>
                        @error('admin_types')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                        @error('admin_types.*')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status <span
                            class="text-red-500">*</span></label>
                    <select name="status" id="status"
                        class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                        required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" placeholder="Enter Password"
                        class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                        required>
                    @error('password')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password
                        <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm Password"
                        class="sm:text-sm w-full border-gray-300 bg-gray-50 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4"
                        required>
                    @error('password_confirmation')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full px-6 py-3 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </x-common.content-container>

</x-layout>
