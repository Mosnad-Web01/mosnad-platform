<div id="sidebar"
    class="bg-gradient-to-b from-indigo-900 via-indigo-800 to-indigo-900 text-white min-h-screen fixed top-0 right-0 shadow-xl z-50 transition-all duration-300 ease-in-out
           md:translate-x-0 transform w-16 lg:w-64 space-y-4 py-2">

    <!-- Collapse Button -->
    <button id="collapse-btn"
        class="absolute -left-3 top-6 w-7 h-7 bg-indigo-600 rounded-full text-white shadow-lg transition-all duration-200 hover:bg-indigo-700 focus:outline-none
               items-center justify-center z-50 lg:flex hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200" id="collapse-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg>
    </button>

    <!-- Logo Section -->
    <div class="flex-shrink-0 px-4">
        <a href="{{ route('home') }}" class="flex items-center justify-center space-x-2">
            <div id="logo-container" class="transition-all duration-300">
                <img id="logo-image" src="{{ asset('images/mosnad-logo-login.svg') }}" alt="Mosnad Logo"
                     class="hidden lg:block max-w-[8rem] mx-auto transition-all duration-300">
                <span id="logo-letter" class="lg:hidden text-indigo-50 text-2xl font-bold transition-all duration-300">
                    M
                </span>
            </div>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 space-y-1 overflow-y-auto px-2">
        <!-- Single Links -->
        <x-layouts.sidebar-link :route="route('home')" :label="'لوحة التحكم '" :icon="'dashboard'" :active="request()->routeIs('home')" />

        <!-- Collapsible Groups -->
        <x-layouts.sidebar-link :label="'إدارة فرص التوظيف'" :icon="'work'"
            :children="[
                ['route' => route('job-opportunities.create'), 'label' => 'إضافة فرصة جديدة', 'icon' => 'add'],
                ['route' => route('job-opportunities.index'), 'label' => 'عرض فرص التوظيف', 'icon' => 'list_alt'],

            ]" />

        <x-layouts.sidebar-link :label="'إدارة المستخدمين'" :icon="'people'"
            :children="[
                ['route' => route('users.index'), 'label' => 'إضافة مستخدم جديد', 'icon' => 'add'],
                ['route' => route('users.index'), 'label' => 'عرض المستخدمين', 'icon' => 'list_alt'],
            ]" />

        <x-layouts.sidebar-link :label="'إدارة الأدوار'" :icon="'verified_user'"
            :children="[
                ['route' => route('roles.index'), 'label' => 'إضافة دور جديد', 'icon' => 'add'],
                ['route' => route('roles.index'), 'label' => 'عرض الأدوار', 'icon' => 'list_alt'],
            ]" />

        <x-layouts.sidebar-link :label="'إدارة الصلاحيات'" :icon="'security'"
            :children="[
                ['route' => route('permissions.index'), 'label' => 'إضافة صلاحية جديدة', 'icon' => 'add'],
                ['route' => route('permissions.index'), 'label' => 'عرض الصلاحيات', 'icon' => 'list_alt'],
            ]" />

        <x-layouts.sidebar-link :label="'إدارة الكورسات'" :icon="'school'"
            :children="[
                ['route' => route('bootcamps.index'), 'label' => 'إضافة كورس جديد', 'icon' => 'add'],
                ['route' => route('bootcamps.index'), 'label' => 'عرض الكورسات', 'icon' => 'list_alt'],
            ]" />

        <x-layouts.sidebar-link :label="'إدارة الاستبيانات'" :icon="'poll'"
            :children="[
                ['route' => route('youth-surveys.index'), 'label' => 'إستبانات الشباب', 'icon' => 'list_alt'],
                ['route' => route('company-surveys.index'), 'label' => 'إستبانات الشركات', 'icon' => 'list_alt'],
            ]" />
    </nav>

    <!-- Logout Section -->
    <div class="flex-shrink-0 mt-auto px-2 ">
        <div class="border-t border-indigo-700 mb-4"></div>
        <x-layouts.sidebar-link :route="route('logout')" :label="'تسجيل الخروج'" :icon="'logout'" />
    </div>
</div>


