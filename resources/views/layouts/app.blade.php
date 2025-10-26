<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'HR System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-yellow-400 text-yellow-900 min-h-screen shadow-lg fixed">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">
                <a href="{{ route('dashboard') }}" class="hover:text-white transition">
                    HRIS
                </a>
            </h1>

            <nav class="space-y-4">
                <a href="{{ route('employees.index') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    All Employee
                </a>
                <a href="{{ route('attendance') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Attendance
                </a>
                <a href="{{ route('promotions.index') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Promotion
                </a>
                <a href="{{ route('salaries.index') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Salary
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block px-4 py-2 font-bold rounded-lg hover:bg-red-500 hover:text-white transition w-full text-left">
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 ml-64">
        @yield('content')
    </main>

    <!-- Scripts Section (for AJAX etc.) -->
    @yield('scripts')

</body>
</html>
