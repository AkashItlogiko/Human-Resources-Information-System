<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-yellow-400 text-yellow-900 min-h-screen shadow-lg">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">HRIS</h1>
            <nav class="space-y-4">
                <a href="{{ route('employee.index') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    All Employee
                </a>
                <a href="{{ route('attendance') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Attendance
                </a>
               <a href="{{ route('promotions.index') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Promotion
               </a>
                <a href="{{ route('salary') }}" class="block px-4 py-2 font-bold rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Salary
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
        <h2 class="text-3xl font-bold mb-6">Welcome to HR Dashboard</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <!-- All Employee Card -->
            <a href="{{ route('employee.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
                <span class="text-2xl font-semibold mb-2">All Employee</span>
                <span class="text-sm">View all employees</span>
            </a>

            <!-- Attendance Card -->
            <a href="{{ route('attendance') }}" class="bg-green-500 hover:bg-green-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
                <span class="text-2xl font-semibold mb-2">Attendance</span>
                <span class="text-sm">Check employee attendance</span>
            </a>

            <!-- Salary Card -->
            <a href="{{ route('salary') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
                <span class="text-2xl font-semibold mb-2">Salary</span>
                <span class="text-sm">Manage salaries</span>
            </a>

        </div>
    </main>

</body>
</html>
