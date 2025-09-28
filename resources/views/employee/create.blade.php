@extends('layouts.app')

@section('title', 'Create Employee')

@section('content')
<div class="bg-white p-6 rounded shadow-md max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Employee</h1>

    <!-- Response Message -->
    <div id="responseMessage" class="mb-4"></div>

    <form id="employeeForm" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- First Name -->
        <div class="mb-4">
            <label class="block text-gray-700">First Name</label>
            <input type="text" name="first_name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label class="block text-gray-700">Last Name</label>
            <input type="text" name="last_name" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Designation -->
        <div class="mb-4">
            <label class="block text-gray-700">Designation</label>
            <input type="text" name="designation" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Phone + Emergency Phone -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700">Phone</label>
                <input type="text" name="phone" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block text-gray-700">Emergency Phone (optional)</label>
                <input type="text" name="emergency_phone" class="w-full border px-3 py-2 rounded">
            </div>
        </div>

        <!-- Salary -->
        <div class="mb-4">
            <label class="block text-gray-700">Salary</label>
            <input type="number" step="0.01" name="salary" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- NID Number -->
        <div class="mb-4">
            <label class="block text-gray-700">NID Number</label>
            <input type="text" name="nid_number" class="w-full border px-3 py-2 rounded" required>
        </div>

        <!-- Present Address -->
        <div class="mb-4">
            <label class="block text-gray-700">Present Address</label>
            <textarea name="present_address" class="w-full border px-3 py-2 rounded" rows="2" required></textarea>
        </div>

        <!-- Permanent Address -->
        <div class="mb-4">
            <label class="block text-gray-700">Permanent Address (optional)</label>
            <textarea name="permanent_address" class="w-full border px-3 py-2 rounded" rows="2"></textarea>
        </div>

        <!-- Profile Photo -->
        <div class="mb-4">
            <label class="block text-gray-700">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="w-full border px-3 py-2 rounded">
            <div class="mt-2">
                <img id="photoPreview" src="" alt="Preview" class="hidden w-32 h-32 object-cover border rounded">
            </div>
        </div>

        <!-- Employee Document -->
        <div class="mb-4">
            <label class="block text-gray-700">Employee Document (pdf/jpg/png)</label>
            <input type="file" name="document_file" accept=".pdf,.jpg,.jpeg,.png" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Save Employee
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // Profile photo preview
    $("#profile_photo").on("change", function (event) {
        let reader = new FileReader();
        reader.onload = function(e) {
            let preview = $("#photoPreview");
            preview.attr("src", e.target.result);
            preview.removeClass("hidden");
        }
        if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
    });

    // AJAX form submit
    $("#employeeForm").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            method: $(this).attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                // Success message
                $("#responseMessage").html('<div class="text-green-600 font-bold">Employee created successfully!</div>');

                // Append new employee to table if table exists
                if ($("#employeeTable").length) {
                    let emp = res.employee;
                    $("#employeeTable").append(
                        `<tr>
                            <td class="border px-3 py-2">${emp.first_name}</td>
                            <td class="border px-3 py-2">${emp.last_name}</td>
                            <td class="border px-3 py-2">${emp.designation || ''}</td>
                            <td class="border px-3 py-2">${emp.email}</td>
                            <td class="border px-3 py-2">${emp.phone}</td>
                            <td class="border px-3 py-2">${emp.salary}</td>
                        </tr>`
                    );
                }

                // Clear form
                $("#employeeForm")[0].reset();
                $("#photoPreview").attr("src","").addClass("hidden");
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let html = '<ul class="text-red-600 font-bold">';
                    $.each(errors, function(key, value){
                        html += `<li>${value[0]}</li>`;
                    });
                    html += '</ul>';
                    $("#responseMessage").html(html);
                } else {
                    $("#responseMessage").html('<div class="text-red-600 font-bold">Something went wrong!</div>');
                }
            }
        });
    });
});
</script>
@endsection
