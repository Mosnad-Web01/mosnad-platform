<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Include Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Include FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>

    <title>{{ $title ?? 'Home' }}</title>

    <!-- Vite for CSS & JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{$title != 'Login' ? 'bg-gray-100' : ''}}">

    @if ($title != 'Login')
        <div class=" initial-layout flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
            {{-- Sidebar --}}
            <x-layouts.sidebar />

            {{--------- Start Main Content ------------------}}
            <div id="main-content"
                class=" flex-1 gap-2 flex flex-col items-center transition-all duration-300 ease-in-out w-full">
                {{--------- NavBar ------------------}}
                <x-layouts.navbar />
                <main class=" px-2 pb-6 w-full space-y-2 overflow-y-auto overflow-x-hidden">
                @if (Session::has('success'))
                        <div
                            class="flex items-center justify-start gap-1 py-1 px-4 w-fit bg-white text-gray-800 border-2 border-green-600 rounded-lg shadow-lg transition-transform transform hover:scale-105 mx-auto">
                            <span class="material-icons text-3xl text-green-700 text-bold ">check</span>
                            <span class="font-semibold text-sm">{{ Session::get('success') }} </span>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div
                            class="flex items-center justify-start gap-1 py-1 px-4 w-fit bg-white text-gray-800 border-2 border-red-600 rounded-lg shadow-lg transition-transform transform hover:scale-105 mx-auto">
                            <span class="material-icons text-3xl text-red-700 text-bold ">close</span>
                            <span class="font-semibold text-sm">{{ Session::get('error') }} </span>
                        </div>
                    @endif
                    {{ $slot }}
                </main>
            </div>
            {{--------- Ends Content ------------------}}

        </div>
    @else
        {{-- Login Page --}}
        {{ $slot }}
    @endif
    <!-- Add this before closing </body> tag -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <script>

        new TomSelect('#admin_types', {
            plugins: ['remove_button'],
            maxItems: null,
            valueField: 'value',
            labelField: 'text',
            searchField: ['text'],
            create: false
        });
    </script>



</body>

</html>
