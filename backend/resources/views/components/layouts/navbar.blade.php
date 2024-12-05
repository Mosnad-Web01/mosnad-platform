<header
    class=" bg-white/90 border-b border-gray-200 shadow-sm py-3 px-4 flex justify-end md:justify-between items-center backdrop-blur-sm sticky top-0 z-10 w-full">
    <!-- Search Bar -->
    <div class="hidden md:flex items-center flex-1 justify-self-center max-w-xl mx-auto">
        <div class="relative w-full">
            <input type="text" placeholder="Search..."
                class="w-full pr-10 pl-4 py-2 rounded-lg border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 text-sm">
            <span class="material-icons absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg">search</span>
        </div>
    </div>

    <!-- left Side -->
    <div class="flex items-center justify-between ">
        <!-- Notification Icon -->
        <div>
            <button class="relative  hover:text-indigo-600 focus:outline-none p-2 hover:scale-110 transition-transform duration-300 ">
                    <span class="material-icons text-2xl text-gray-500 ">notifications</span>
                <span
                    class="absolute top-1 left-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">3</span>
            </button>
        </div>
        <div>
            <button class="relative  focus:outline-none p-2 hover:scale-110 transition-transform duration-300 ">
                    <span class="material-icons text-2xl text-gray-500  ">mail</span>
                <span
                    class="absolute top-1 left-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center">5</span>
            </button>
        </div>
        {{-- <div>
            <button class="relative  hover:text-indigo-600 focus:outline-none p-2">
                    <span class="material-icons text-2xl text-gray-500 ">settings</span>
            </button>
        </div> --}}
        
        <!-- User Avatar -->
        <div class="flex items-center space-x-2 border-r pr-4  border-gray-200 gap-2">
            <div>
                <button class="relative  focus:outline-none p-2 ">
                        <span class="material-icons text-2xl text-red-500 hover:scale-110 transition-transform duration-300 ">logout</span>
                </button>
            </div>
            <div class="flex flex-col items-end space-y-1 cursor-pointer">
                <span class="text-gray-900 font-bold text-md ">
                    {{ Auth::user()->name ?? 'Ahmed Al-Sanadi'}}
                </span>
                {{-- <span class="text-xs text-gray-500">Admin</span> --}}
            </div>

            <div class="w-10 h-10 rounded-full bg-indigo-700 flex items-center justify-center  cursor-pointer">
                <span class="text-indigo-100 text-md font-bold ">
                    <!-- take the first letter of the user name and capitalize them -->
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}

                </span>
            </div>

        </div>
    </div>
</header>