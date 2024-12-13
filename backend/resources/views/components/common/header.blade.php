<header class="bg-white shadow py-2 px-3 sm:py-8 sm:px-6 rounded-2xl relative overflow-hidden">
    <div class="flex items-center justify-between">
        <!-- Title -->
        <h1 class="text-sm text-[#21255C] font-bold relative w-fit after:content-[''] after:absolute after:w-[calc(100%+2.5rem)] after:h-12 after:bg-blue-500/20 after:rounded-tl-full after:rounded-bl-full after:right-[-24px] after:top-1/2 after:-translate-y-1/2">
            {{ $title }}
        </h1>

        <!-- Optional Back Button -->
        @if($showBackButton ?? false)
        <a href="javascript:history.back()" class="text-blue-700 hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 px-3 py-1 rounded-md bg-white border border-blue-500  flex items-center justify-center transition-all duration-200 ease-in-out hover:bg-blue-50">
    <i class="fas fa-arrow-left text-lg"></i>
</a>
        @endif
    </div>
</header>
