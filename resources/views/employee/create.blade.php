{{-- resources/views/employee/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold mb-4">Create Employee</h1>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">First Name</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" class="border p-2 w-full" required>
            @error('first_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Last Name</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" class="border p-2 w-full" required>
            @error('last_name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full">
            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="border p-2 w-full">
                @error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block mb-1">Emergency Phone (optional)</label>
                <input type="text" name="emergency_phone" value="{{ old('emergency_phone') }}" class="border p-2 w-full">
                @error('emergency_phone') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block mb-1">Salary</label>
            <input type="number" step="0.01" name="salary" value="{{ old('salary') }}" class="border p-2 w-full">
            @error('salary') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">NID Number </label>
            <input type="text" name="nid_number" value="{{ old('nid_number') }}" class="border p-2 w-full">
            @error('nid_number') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Present Address</label>
            <textarea name="present_address" class="border p-2 w-full" rows="2">{{ old('present_address') }}</textarea>
            @error('present_address') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Permanent Address (optional)</label>
            <textarea name="permanent_address" class="border p-2 w-full" rows="2">{{ old('permanent_address') }}</textarea>
            @error('permanent_address') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Profile Photo </label>
            <input type="file" name="profile_photo" accept="image/*" onchange="previewImage(event)" class="border p-2 w-full">
            @error('profile_photo') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">Employee Document (pdf/jpg/png)</label>
            <input type="file" name="document_file" accept=".pdf,image/*" class="border p-2 w-full">
            @error('document_file') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        {{-- Preview Image --}}
        <div>
            <img id="preview" src="#" alt="Image Preview" class="w-24 h-24 mt-2 object-cover rounded-full" style="max-width: 200px; display:none;">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Employee</button>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
