@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-3xl font-bold mb-6">Welcome to HR Dashboard</h2>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        <!-- All Employee Card -->
        <a href="{{ route('employees.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
            <span class="text-2xl font-semibold mb-2">All Employee</span>
            <span class="text-sm">View all employees</span>
        </a>

        <!-- Attendance Card -->
        <a href="{{ route('attendance') }}" class="bg-green-500 hover:bg-green-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
            <span class="text-2xl font-semibold mb-2">Attendance</span>
            <span class="text-sm">Check employee attendance</span>
        </a>

        <!-- Salary Card -->
        <a href="{{ route('salaries.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-8 rounded-lg shadow-lg flex flex-col items-center justify-center transition duration-300">
            <span class="text-2xl font-semibold mb-2">Salary</span>
            <span class="text-sm">Manage salaries</span>
        </a>
    </div>
@endsection
