<!DOCTYPE html>
<html>
<head>
    <title>All Employees</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Employees</h1>
        <a href="{{ route('employee.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Create Employee</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">First Name</th>
                <th class="py-2 px-4 border-b">Last Name</th>
                <th class="py-2 px-4 border-b">Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td class="py-2 px-4 border-b">{{ $employee->first_name }}</td>
                <td class="py-2 px-4 border-b">{{ $employee->last_name }}</td>
                <td class="py-2 px-4 border-b">
                    @if($employee->profile_photo)
                        <img src="{{ asset('employees/' . $employee->profile_photo) }}" width="50" class="rounded">
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



</body>
</html>
