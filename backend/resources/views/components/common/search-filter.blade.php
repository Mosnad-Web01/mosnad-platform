<div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
    <form method="GET" class="space-y-4 sm:space-y-0 sm:flex sm:gap-4">
        <!-- Search Input Group -->
        <div class="flex-1 relative">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="بحث عن الاسم أو البريد أو الهاتف" 
                    value="{{ request('search') }}" 
                    class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 placeholder-gray-400 hover:border-gray-300"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 group-hover:text-blue-500 transition-colors duration-300">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

          <!-- Role Select Group -->
          <div class="w-full sm:w-48 relative group">
            <select 
                name="role" 
                class="w-full px-8 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 appearance-none hover:border-gray-300"
            >
                <option value="">كل الأدوار</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-all duration-300 hover:shadow-md active:scale-95 flex items-center justify-center gap-2">
            <i class="fas fa-filter"></i>
            تصفية
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const button = form.querySelector('button[type="submit"]');
        button.classList.add('scale-95');
        setTimeout(() => {
            button.classList.remove('scale-95');
        }, 150);
    });
});
</script>
