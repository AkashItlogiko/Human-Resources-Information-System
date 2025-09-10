{{-- resources/views/employee/edit.blade.php --}}
@extends('layouts.app') {{-- layouts.app extend--}}

@section('content') {{-- layouts.app er content section start --}}
<div class="bg-gray-100 p-6">

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
    <input type="file" name="profile_photo" id="profile_photo"
           class="w-full border px-3 py-2 rounded"
           onchange="previewProfilePhoto(event)">

    {{-- Old Photo --}}
    @if($employee->profile_photo)
        <img id="oldPhoto" src="{{ asset('employees/' . $employee->profile_photo) }}"
             class="w-24 h-24 mt-2 object-cover rounded-full">
    @endif

    {{-- New Preview (hidden by default) --}}
    <img id="preview" class="w-24 h-24 mt-2 object-cover rounded-full hidden">
</div>

                <script>
                    function previewProfilePhoto(event) {
                        var reader = new FileReader();
                        reader.onload = function(){
                            var preview = document.getElementById('preview');
                            var oldPhoto = document.getElementById('oldPhoto');

                            preview.src = reader.result;
                            preview.classList.remove('hidden');

                            // If a previous photo exists, it will be hidden.
                            if(oldPhoto){
                                oldPhoto.style.display = 'none';
                            }
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>


            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>

</div>
@endsection {{-- content section end --}}
