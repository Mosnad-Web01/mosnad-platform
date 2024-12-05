<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Include Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>{{ $title ?? 'Home' }}</title>

    <!-- Vite for CSS & JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{$title != 'Login' ? 'bg-gray-100' : ''}}">

    @if ($title != 'Login')
        <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
            {{-- Sidebar --}}
            <x-layouts.sidebar />

            {{--------- Start Main Content ------------------}}
            <div id="main-content"
                class="flex-1 gap-2 flex flex-col items-center transition-all duration-300 ease-in-out w-full">
                {{--------- NavBar ------------------}}
                <x-layouts.navbar />
                <main class="px-2 pb-6 w-full space-y-2 overflow-y-auto overflow-x-hidden">
                    {{ $slot }}
                </main>
            </div>
            {{--------- Ends Content ------------------}}

        </div>
    @else
        {{-- Login Page --}}
        {{ $slot }}
    @endif

</body>

</html>
