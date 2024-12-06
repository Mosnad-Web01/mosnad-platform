<header class="bg-white shadow py-5 px-3 sm:py-8 sm:px-6 rounded-2xl relative overflow-hidden">
    <div class="flex items-center justify-between">
        <!-- Title -->
        <h1 class="text-sm text-[#21255C] font-bold relative w-fit after:content-[''] after:absolute after:w-[calc(100%+2.5rem)] after:h-12 after:bg-blue-500/20 after:rounded-tl-full after:rounded-bl-full after:right-[-24px] after:top-1/2 after:-translate-y-1/2">
            {{ $title }}
        </h1>

        <!-- Optional Back Button -->
        @if($showBackButton ?? false)
        <a href="javascript:history.back()" class="text-blue-500 font-medium hover:underline text-sm px-1 py-1.5 bg-blue-100 rounded-lg flex items-center">
            <!-- Back Icon --> رجوع
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
           
        </a>
        @endif
    </div>
</header>
