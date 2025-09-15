{{-- resources/views/attendance/create.blade.php --}}
@extends('layouts.app') {{-- layouts.app extend--}}

@section('content') {{-- layouts.app er content section start --}}
<div class="p-6 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Mark Attendance</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf

    <label class="font-bold mb-2 block">Date</label>
    <input type="date"
           name="date"
           required
           class="border p-2 mb-4 rounded"
           value="{{date('Y-m-d')}}"
           max="{{date('Y-m-d')}}">
        <!-- Responsive Wrapper -->
        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded shadow border-collapse hidden md:table">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-3 w-1/2">Employee</th>
                        <th class="p-3 w-1/2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 align-middle">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                                <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                            </td>
                            <td class="p-3 align-middle">
                                <select name="status[]" class="border rounded p-2 w-full">
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Leave">Leave</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mobile Cards -->
            <div class="space-y-4 md:hidden">
                @foreach($employees as $employee)
                    <div class="bg-white p-4 rounded shadow border">
                        <p class="font-semibold">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                        <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                        <label class="block mt-2 text-sm font-medium">Status</label>
                        <select name="status[]" class="border rounded p-2 w-20">
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="Leave">Leave</option>
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
    </form>

    <a href="{{ route('attendance.history') }}" class="mt-6 inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">View History</a>

</div>
@endsection {{-- content section end --}}
