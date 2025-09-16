@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Attendance History</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('attendance.history') }}" class="mb-4 flex space-x-2">
        <!-- Employee Dropdown -->
        <select name="employee_id" class="border p-2 rounded">
            <option value="">All Employees</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </option>
            @endforeach
        </select>

        <!-- Month Dropdown -->
        <select name="month" class="border p-2 rounded">
            <option value="">Select Month</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ date("F", mktime(0, 0, 0, $m, 1)) }}
                </option>
            @endfor
        </select>

        <!-- Year Dropdown -->
        <select name="year" class="border p-2 rounded">
            <option value="">Select Year</option>
            @for ($y = date('Y'); $y >= 2020; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Attendance Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded shadow border-collapse">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">Employee</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 align-middle">
                            {{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}
                        </td>
                        <td class="p-3 align-middle">{{ $attendance->date }}</td>
                        <td class="p-3 align-middle">{{ $attendance->status }}</td>
                        <td class="p-3 align-middle text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('attendance.edit', $attendance->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                                <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure to delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">
                            No attendance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('attendance') }}"
       class="mt-6 inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
        Back to Attendance
    </a>

</div>
@endsection
