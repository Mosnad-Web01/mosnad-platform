@props(['route' => null, 'label', 'active' => false, 'icon', 'children' => []])

@if(empty($children))

<!-- Only For Logout -->
@if($icon == "logout")
<form action="/logout" method="POST">
    @csrf
    <div>
        <button
            type="submit"
            class=" flex items-center px-4 py-3 rounded-xl transition-all duration-300 relative overflow-hidden group  'text-gray-200 hover:text-white hover:bg-indigo-600/20 sidebar-link w-full">
            <!-- Icon -->
            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-700/30 group-hover:bg-indigo-600/50 transition-all duration-300
                        {{ $active ? 'bg-indigo-600 text-white' : 'text-indigo-300 group-hover:text-white' }}">
                <span class="material-icons group-hover:scale-110 transition-transform duration-300">
                    {{ $icon }}
                </span>
            </div>

            <!-- Label -->
            <div class=" sidebar-text ">
                <div class="relative z-10  font-medium text-sm
                        {{ $active ? 'text-2xl font-bold' : 'text-md font-medium' }} transition-all duration-300 group-hover:translate-x-1 rtl:group-hover:-translate-x-1">
                    {{ $label }}
                </div>
            </div>
        </button>
    </div>
</form>
@else
<!------------ Only Links without children ----------->
<a href="{{ $route }}"
    class=" flex items-center px-4 py-3 rounded-xl transition-all duration-300 relative overflow-hidden group
            {{ $active ? 'text-white font-bold bg-indigo-700' : 'text-gray-200 hover:text-white hover:bg-indigo-600/20' }} sidebar-link ">
    <!-- Icon -->

    <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-700/30 group-hover:bg-indigo-600/50 transition-all duration-300
            {{ $active ? 'bg-indigo-600 text-white' : 'text-indigo-300 group-hover:text-white' }}">
        <span class="material-icons group-hover:scale-110 transition-transform duration-300">
            {{ $icon }}
        </span>
    </div>

    <!-- Label -->
    <div class=" sidebar-text ">
        <div class="relative z-10  font-medium text-sm
            {{ $active ? 'text-2xl font-bold' : 'text-md font-medium' }} transition-all duration-300 group-hover:translate-x-1 rtl:group-hover:-translate-x-1">
            {{ $label }}
        </div>
    </div>
</a>
@endif
@else
<!----------- Links With Children -------------------------------->
<div x-data="{ open: false }" class="relative">

    <!-- This will be converted to a normal link in case of collapsed sidebar ----------->
    <a href="{{ $children[0]['route'] }}"
        class=" hidden items-center px-4 py-3 rounded-xl transition-all duration-300 relative overflow-hidden group
           {{ $active ? 'text-white font-bold bg-indigo-700' : 'text-gray-200 hover:text-white hover:bg-indigo-600/20' }} normalSidbarLink   ">
        <!-- Icon -->
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-700/30 group-hover:bg-indigo-600/50 transition-all duration-300
            {{ $active ? 'bg-indigo-600 text-white' : 'text-indigo-300 group-hover:text-white' }}">
            <span class="material-icons group-hover:scale-110 transition-transform duration-300">
                {{ $icon }}
            </span>
        </div>
    </a>
    <!-- This will be converted to a dropdown link in case of expanded sidebar -->
    <div class=" dropDownLink ">
        <button @click="open = !open"
            class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-300 relative overflow-hidden group ">
            <div class="relative z-10 flex items-center gap-3 flex-1">
                <!-- Icon -->
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-700/30 group-hover:bg-indigo-600/50 transition-all duration-300">
                    <span class="material-icons group-hover:scale-110 transition-transform duration-300">
                        {{ $icon }}
                    </span>
                </div>
                <!-- Label -->
                <div class="sidebar-text font-medium text-sm transition-all duration-300 group-hover:translate-x-1">
                    {{ $label }}
                </div>
            </div>

            <div class="relative z-10 sidebar-text">
                <span class="material-icons transform transition-transform duration-300 text-indigo-300 group-hover:text-white"
                    :class="{ 'rotate-180': open }">
                    expand_more
                </span>
            </div>
        </button>

        <div x-show="open"
            x-transition:enter="transition-all duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-[-10px]"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            class="relative pr-6 rtl:pr-0 rtl:pl-6">
            <div class="space-y-1 pt-2">
                @foreach ($children as $child)
                <a href="{{ $child['route'] }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-xl transition-all duration-300 group relative overflow-hidden hover:bg-indigo-600/20">
                    <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-indigo-800/30 group-hover:bg-indigo-700/40 transition-all duration-300">
                        <span class="material-icons text-sm text-indigo-300 group-hover:text-white transition-all duration-300">
                            {{ $child['icon'] }}
                        </span>
                    </div>
                    <div class="sidebar-text text-sm text-gray-300 group-hover:text-white transition-colors duration-300">
                        {{ $child['label'] }}
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif