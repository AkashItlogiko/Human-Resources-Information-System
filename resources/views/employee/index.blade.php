{{-- resources/views/employee/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Employees</h1>
        <a href="{{ route('employee.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Create Employee</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow text-center">
            <thead>
                <tr>
                    <th class="py-3 px-4 border-b">Name</th>
                    <th class="py-3 px-4 border-b">Email</th>
                    <th class="py-3 px-4 border-b">Phone</th>
                    <th class="py-3 px-4 border-b">Salary</th>
                    <th class="py-3 px-4 border-b">NID</th>
                    <th class="py-3 px-4 border-b">Photo</th>
                    <th class="py-3 px-4 border-b">Present Address</th>
                    <th class="py-3 px-4 border-b">Permanent Address</th>
                    <th class="py-3 px-4 border-b">Document</th>
                    <th class="py-3 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $employee->email ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $employee->phone ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $employee->salary ? number_format($employee->salary,2) : 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $employee->nid_number ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($employee->profile_photo)
                            <div class="flex justify-center">
                                <img src="{{ asset('employees/' . $employee->profile_photo) }}" class="w-16 h-16 object-cover rounded-full">
                            </div>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">{{ $employee->present_address ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">{{ $employee->permanent_address ?? 'N/A' }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($employee->document_file)
                            <a href="{{ asset('employees/' . $employee->document_file) }}" target="_blank" class="text-blue-600 hover:underline">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('employee.edit', $employee->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>

                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-4">No employees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
