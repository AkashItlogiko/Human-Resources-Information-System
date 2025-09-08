{{-- resources/views/employee/create.blade.php --}}
@extends('layouts.app') {{-- layouts.app extend --}}

@section('content') {{-- layouts.app er content section start --}}
<div class="bg-gray-100 p-6">

    <h1 class="text-3xl font-bold mb-4">Create Employee</h1>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">First Name</label>
            <input type="text" name="first_name" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block mb-1">Last Name</label>
            <input type="text" name="last_name" class="border p-2 w-full" required>
        </div>
        <div>
            <label class="block mb-1">Photo</label>
            <input type="file" name="profile_photo" class="border p-2 w-full">
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Employee</button>
    </form>

</div>
@endsection {{-- content section end --}}
