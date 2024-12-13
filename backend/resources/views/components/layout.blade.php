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
        <div class="flex min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
            {{-- Sidebar --}}
            <x-layouts.sidebar />

            {{--------- Start Main Content ------------------}}
            <div id="main-content" class="flex-1 gap-2 flex flex-col items-center w-full">

                <!-- Delete Modal -->
                <x-common.delete-modal />

                {{--------- NavBar ------------------}}
                <x-layouts.navbar />
                <main class="px-2 pb-6 w-full space-y-2 overflow-y-auto overflow-x-hidden">


                    <!-- Add this where you want the toasts to appear -->
                    <div id="toastContainer" class="toast-container" dir="ltr"></div>

                    <!-- Replace your existing notification code with this -->
                    @if(Session::has('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast('{{ Session::get('success') }}', 'success');
                            });
                        </script>
                    @endif

                    @if(Session::has('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                showToast('{{ Session::get('error') }}', 'error');
                            });
                        </script>
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
    <!-- Toast Container -->
    <script>
        function showToast(message, type = 'success', duration = 5000) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const icons = {
                success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`,
                error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>`
            };

            toast.innerHTML = `
        <div class="toast-content">
            <div class="toast-icon">
                ${icons[type]}
            </div>
            <div class="toast-message">${message}</div>
            <div class="toast-close" onclick="closeToast(this.parentElement.parentElement)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>
        <div class="toast-progress">
            <div class="toast-progress-bar" style="width: 100%"></div>
        </div>
    `;

            container.appendChild(toast);

            // Start progress bar animation
            const progressBar = toast.querySelector('.toast-progress-bar');
            progressBar.style.transition = `width ${duration}ms linear`;

            // Use setTimeout to ensure the transition is applied
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 10);

            // Remove toast after duration
            const timeout = setTimeout(() => {
                closeToast(toast);
            }, duration);

            // Store timeout in toast element
            toast.dataset.timeout = timeout;
        }

        function closeToast(toast) {
            // Clear the timeout
            clearTimeout(parseInt(toast.dataset.timeout));

            // Add sliding out animation
            toast.style.animation = 'slideOut 0.5s ease forwards';

            // Remove toast after animation
            setTimeout(() => {
                toast.remove();
            }, 500);
        }

    </script>
    <!-- Tom Select -->
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
