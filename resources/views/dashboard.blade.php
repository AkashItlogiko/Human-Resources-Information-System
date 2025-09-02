<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - HR System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
   <header class="bg-yellow-400 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-yellow-900">HR Dashboard</h1>
    </div>
    </header>


    <!-- Main Dashboard -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <!-- All Employee Card -->
            <a href="{{ route('employees') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
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
