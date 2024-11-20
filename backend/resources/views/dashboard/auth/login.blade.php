<x-layout :navbar="false">
    <div class="flex items-center justify-center h-screen lg:flex-row flex-col bg-gray-50">
        <!-- Left side (form) -->
        <div class="flex flex-1 flex-col items-center justify-center p-4">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-start text-2xl mb-6 font-bold">أهلاً في منصة مسند للتدريب </h2>
                <p class="mb-6 text-gray-500">تسجيل الدخول الى لوحة التحكم</p>
              

                <form action="{{ route('dashboard.login') }}" method="POST">
                    @csrf
                    <x-form.input
                        name="email"
                        label="البريد الإلكتروني"
                        type="email"
                        placeholder="user@example.com"
                        icon="fa fa-user"
                        inputClass="border-gray-300" />

                    <x-form.input
                        name="password"
                        label="كلمة المرور"
                        type="password"
                        placeholder="أدخل كلمة المرور"
                        icon="fa fa-lock"
                        inputClass="border-gray-300" />
                   
                    <button type="submit" class="w-full py-2 bg-gradient text-white rounded-md mt-2">
                        تسجيل الدخول
                    </button>
                </form>
            </div>
        </div>

        <!-- Right side (image) - hidden on small screens -->
        <div class="hidden lg:flex flex-1 flex-col items-center bg-blue-100 h-full justify-center py-6">
            <img src="{{ asset('images/mosnad-logo-login.svg') }}" alt="Mosnad Logo" class="max-w-xs mx-auto">
        </div>
    </div>
</x-layout>