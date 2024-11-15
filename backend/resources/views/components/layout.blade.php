<!DOCTYPE html>
<html lang="ar" dir="rtl" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- Vite for CSS -->
    @vite('resources/css/app.css')

    <!-- Vite for JS -->
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100">

    <!-- Navbar (Optional) -->
    @if($navbar ?? true)
        <nav class="bg-blue-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-white text-lg">Dashboard</a>
                <div>
                    @auth
                        <form action="{{ route('dashboard.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <div >
        {{ $slot }}
    </div>

</body>
</html>
