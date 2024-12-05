<div class="bg-white shadow rounded-2xl p-4 mt-60 max-h-screen w-full overflow-auto">
    @isset($title) <!-- Check if the title is set -->
        <h2 class="text-xs border-b border-gray-100 pb-3 font-bold text-[#21255C] mb-4">{{ $title }}</h2>
    @endisset
    {{ $slot }}
</div>
