<x-layout title="Bootcamps">
    <x-common.header title="الدورات التدريبية" />

    <x-common.content-container title="جدول الدورات التدريبية">
        <div class="relative overflow-hidden rounded-xl shadow-lg bg-white">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرقم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الاسم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">المدرب</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">المدينة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الرسوم</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">المدة</th>
                            <th class="px-4 sm:px-6 py-4 text-start text-sm font-bold text-white whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bootcamps as $bootcamp)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $bootcamp->id }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                <a href="{{ route('bootcamps.show', $bootcamp->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $bootcamp->name }}
                                </a>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $bootcamp->instructor }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $bootcamp->city }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $bootcamp->fees }}$</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap">{{ $bootcamp->training_duration }} أسابيع</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700 whitespace-nowrap flex justify-start gap-3">
                                <!-- Edit Button -->
                                <a href="{{ route('bootcamps.edit', $bootcamp->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <button onclick="openDeleteModal('{{ $bootcamp->id }}')" class="ml-2 text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-common.pagination :items="$bootcamps" />

        <!-- Empty State -->
        @if($bootcamps->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد بيانات</h3>
        </div>
        @endif
    </x-common.content-container>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-500 bg-opacity-50 transition-opacity duration-300 ease-in-out">
        <div class="bg-white p-8 rounded-xl shadow-lg w-96 max-w-md">
            <h2 class="text-xl font-semibold text-gray-800">هل أنت متأكد من حذف هذا المخيم التدريبي؟</h2>
            <div class="mt-6 flex justify-end gap-4">
                <!-- Cancel Button -->
                <button onclick="closeDeleteModal()" class="px-6 py-2 text-sm text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400 transition-colors duration-300">
                    إلغاء
                </button>
                <!-- Confirm Delete Button -->
                <form id="deleteForm" method="POST" action="" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors duration-300">
                        حذف
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-layout>

<!-- JavaScript for Modal -->
<script>
    let deleteModal = document.getElementById('deleteModal');
    let deleteForm = document.getElementById('deleteForm');

    function openDeleteModal(bootcampId) {
        // Set the action for the delete form
        deleteForm.action = '/bootcamps/' + bootcampId; // Adjust the route as needed
        // Show the modal
        deleteModal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        // Hide the modal
        deleteModal.classList.add('hidden');
    }
</script>