<!DOCTYPE html>
<html>
<head>
    <title>Attendance History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Attendance History</h1>

    <form method="GET" action="{{ route('attendance.history') }}" class="mb-4 flex flex-wrap gap-4">
        <select name="employee_id" class="border p-2 rounded">
            <option value="">All Employees</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}" class="border p-2 rounded">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

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
                @foreach($attendances as $attendance)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 align-middle">
                            {{ $attendance->employee->first_name }} {{ $attendance->employee->last_name }}
                        </td>
                        <td class="p-3 align-middle">
                            {{ $attendance->date }}
                        </td>
                        <td class="p-3 align-middle">
                            {{ $attendance->status }}
                        </td>
                        <td class="p-3 align-middle text-center">
                            <div class="flex justify-center gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('attendance.edit', $attendance->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Edit</a>

                                <!-- Delete Form -->
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
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('attendance') }}"
       class="mt-6 inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Back to Attendance</a>

</body>
</html>
