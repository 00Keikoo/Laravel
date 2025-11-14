<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'App Pegawai')</title>
    <!-- Pastikan sudah include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold">@yield('page-title', 'App Pegawai')</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition">Employee</a>
                <a href="{{ url('/departments') }}" class="text-gray-600 hover:text-blue-600 transition">Department</a>
                <a href="{{ url('/attendance') }}" class="text-gray-600 hover:text-blue-600 transition">Attendance</a>
                <a href="{{ url('/report') }}" class="text-gray-600 hover:text-blue-600 transition">Report</a>
                <a href="{{ url('/salaries') }}" class="text-gray-600 hover:text-blue-600 transition">Salary</a>
                <a href="{{ url('/positions') }}" class="text-gray-600 hover:text-blue-600 transition">Position</a>
            </nav>
            <!-- Menu mobile -->
            <div class="md:hidden">
                <button id="mobileMenuButton" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <!-- ikon hamburger simple -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile menu dropdown -->
        <nav id="mobileMenu" class="hidden bg-white border-t border-gray-200 md:hidden">
            <div class="px-4 py-2 space-y-2">
                <a href="{{ url('/') }}" class="block text-gray-600 hover:text-blue-600 transition">Employee</a>
                <a href="{{ url('/department') }}" class="block text-gray-600 hover:text-blue-600 transition">Department</a>
                <a href="{{ url('/attendance') }}" class="block text-gray-600 hover:text-blue-600 transition">Attendance</a>
                <!-- <a href="{{ url('/report') }}" class="block text-gray-600 hover:text-blue-600 transition">Report</a> -->
                <a href="{{ url('/salaries') }}" class="block text-gray-600 hover:text-blue-600 transition">Salary</a>
                <a href="{{ url('/positions') }}" class="block text-gray-600 hover:text-blue-600 transition">Position</a>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script>
        // JS minimal untuk toggling mobile menu
        const btn = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
