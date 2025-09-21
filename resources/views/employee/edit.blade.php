{{-- resources/views/employee/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Employee</h1>

        <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="w-full border px-3 py-2 rounded">
                @error('first_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="w-full border px-3 py-2 rounded">
                @error('last_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="w-full border px-3 py-2 rounded">
                @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="w-full border px-3 py-2 rounded">
                    @error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block mb-1">Emergency Phone</label>
                    <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $employee->emergency_phone) }}" class="w-full border px-3 py-2 rounded">
                    @error('emergency_phone') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Salary</label>
                <input type="number" step="0.01" name="salary" value="{{ old('salary', $employee->salary) }}" class="w-full border px-3 py-2 rounded">
                @error('salary') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">NID Number</label>
                <input type="text" name="nid_number" value="{{ old('nid_number', $employee->nid_number) }}" class="w-full border px-3 py-2 rounded">
                @error('nid_number') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Present Address</label>
                <textarea name="present_address" class="w-full border px-3 py-2 rounded" rows="2">{{ old('present_address', $employee->present_address) }}</textarea>
                @error('present_address') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Permanent Address</label>
                <textarea name="permanent_address" class="w-full border px-3 py-2 rounded" rows="2">{{ old('permanent_address', $employee->permanent_address) }}</textarea>
                @error('permanent_address') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" class="w-full border px-3 py-2 rounded" onchange="previewProfilePhoto(event)">

                {{-- Old Photo --}}
                @if($employee->profile_photo)
                    <img id="oldPhoto" src="{{ asset('employees/' . $employee->profile_photo) }}" class="w-24 h-24 mt-2 object-cover rounded-full">
                @endif

                {{-- New Preview (hidden by default) --}}
                <img id="preview" class="w-24 h-24 mt-2 object-cover rounded-full hidden">
                @error('profile_photo') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Employee Document</label>
                <input type="file" name="document_file" class="w-full border px-3 py-2 rounded">

                @if($employee->document_file)
                    <div class="mt-2">
                        <a href="{{ asset('employees/' . $employee->document_file) }}" target="_blank" class="text-blue-600 hover:underline">Current document</a>
                    </div>
                @endif
                @error('document_file') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</div>

<script>
    function previewProfilePhoto(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var preview = document.getElementById('preview');
            var oldPhoto = document.getElementById('oldPhoto');

            preview.src = reader.result;
            preview.classList.remove('hidden');

            if (oldPhoto) {
                oldPhoto.style.display = 'none';
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
