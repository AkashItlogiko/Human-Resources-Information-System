<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'designation' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'salary' => 'required|numeric',
            'phone' => 'required|string',
            'emergency_phone' => 'nullable|string',
            'nid_number' => 'required|string',
            'present_address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Profile photo upload
        if ($request->hasFile('profile_photo')) {
            $fileName = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('employees'), $fileName);
            $data['profile_photo'] = $fileName;
        }

        // Document upload (keep inside employees/documents)
        if ($request->hasFile('document_file')) {
            $docName = time() . '_doc.' . $request->document_file->extension();
            $request->document_file->move(public_path('employees/documents'), $docName);
            $data['document_file'] = 'documents/' . $docName;
        }

        Employee::create($data);

        return redirect()->route('employee.index')
                         ->with('success', 'Employee created successfully');
    }

    // Edit Function
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    // Update Function
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'designation' => 'nullable|string',
            'email' => ['required','email', Rule::unique('employees')->ignore($employee->id)],
            'salary' => 'required|numeric',
            'phone' => 'required|string',
            'emergency_phone' => 'nullable|string',
            'nid_number' => 'required|string',
            'present_address' => 'required|string',
            'permanent_address' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Profile photo replace
        if ($request->hasFile('profile_photo')) {
            // delete old if exists
            if ($employee->profile_photo && file_exists(public_path('employees/' . $employee->profile_photo))) {
                @unlink(public_path('employees/' . $employee->profile_photo));
            }
            $fileName = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('employees'), $fileName);
            $data['profile_photo'] = $fileName;
        }

        // Document replace
        if ($request->hasFile('document_file')) {
            if ($employee->document_file && file_exists(public_path('employees/' . $employee->document_file))) {
                @unlink(public_path('employees/' . $employee->document_file));
            }
            $docName = time() . '_doc.' . $request->document_file->extension();
            $request->document_file->move(public_path('employees/documents'), $docName);
            $data['document_file'] = 'documents/' . $docName;
        }

        $employee->update($data);

        return redirect()->route('employee.index')
                         ->with('success', 'Employee updated successfully');
    }

    // Delete Function
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->profile_photo && file_exists(public_path('employees/' . $employee->profile_photo))) {
            @unlink(public_path('employees/' . $employee->profile_photo));
        }

        if ($employee->document_file && file_exists(public_path('employees/' . $employee->document_file))) {
            @unlink(public_path('employees/' . $employee->document_file));
        }

        $employee->delete();

        return redirect()->route('employee.index')
                         ->with('success', 'Employee deleted successfully');
    }
}
