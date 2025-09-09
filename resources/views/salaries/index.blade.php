@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Employee Salary List</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @php
        $totalSalary = $employees->sum('salary');
    @endphp

    <div class="mb-4 p-3 bg-blue-200 text-blue-900 rounded">
        <strong>Total Salary Expense: </strong> {{ number_format($totalSalary, 2) }}
    </div>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Employee Name</th>
                <th class="py-2 px-4">Current Salary</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                    <td class="py-2 px-4">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td class="py-2 px-4">{{ number_format($employee->salary, 2) }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('salaries.create', $employee->id) }}" class="px-3 py-1 bg-green-500 text-white rounded">Create</a>
                        <a href="{{ route('salaries.edit', $employee->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <a href="{{ route('salaries.history', $employee->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">History</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
