<div id="deleteModal"
    class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300 ease-in-out">
    <div
        class="bg-white p-8 rounded-3xl shadow-2xl w-96 max-w-md transform scale-95 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col items-center">
            <div class="bg-red-100 text-red-600 rounded-full p-4 mb-4">
                <span class="material-icons text-5xl">warning</span>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-800 mb-2">تحذير!</h2>
            <p id="deleteMessage" class="text-center text-gray-600 mb-6"
                data-default-message="هل أنت متأكد من أنك تريد حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء.">
                هل أنت متأكد من أنك تريد حذف هذا العنصر؟ لا يمكن التراجع عن هذا الإجراء.
            </p>
        </div>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-between gap-4">
                <button type="button"
                    class="w-full bg-gray-300 text-gray-800 px-4 py-2 rounded-full font-semibold hover:bg-gray-400 transition duration-300 ease-in-out"
                    onclick="closeDeleteModal()">
                    إلغاء
                </button>
                <button type="submit"
                    class="w-full bg-red-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-red-700 transition duration-300 ease-in-out">
                    حذف
                </button>
            </div>
        </form>
    </div>
</div>