<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Employee</h1>

        <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ $employee->first_name }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ $employee->last_name }}" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1">Profile Photo</label>
                <input type="file" name="profile_photo" class="w-full border px-3 py-2 rounded">
                @if($employee->profile_photo)
                    <img src="{{ asset('employees/' . $employee->profile_photo) }}" class="w-24 h-24 mt-2 object-cover rounded-full">
                @endif
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>

</body>
</html>
