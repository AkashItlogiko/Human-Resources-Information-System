{{-- resources/views/attendance/edit.blade.php --}}
@extends('layouts.app') {{-- layouts.app extend --}}

@section('content') {{-- layouts.app er content section start --}}
<div class="p-6 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Edit Attendance Status</h1>

    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

      
        <div class="mb-4">
            <label class="block font-bold mb-1">Status</label>
            <select name="status" class="border p-2 rounded w-full">
                <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                <option value="Leave" {{ $attendance->status == 'Leave' ? 'selected' : '' }}>Leave</option>
            </select>
        </div>

        {{-- Submit & Cancel Buttons --}}
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
        <a href="{{ route('attendance.history') }}" class="ml-2 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Cancel
        </a>
    </form>

</div>
@endsection {{-- content section end --}}
