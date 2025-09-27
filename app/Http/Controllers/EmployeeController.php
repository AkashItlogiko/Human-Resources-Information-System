<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // list
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    // create form
    public function create()
    {
        return view('employee.create');
    }

    // store
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'designation'       => 'nullable|string',
            'email'             => 'required|email|unique:employees,email',
            'salary'            => 'required|numeric',
            'phone'             => 'required|string',
            'emergency_phone'   => 'nullable|string',
            'nid_number'        => 'required|string',
            'present_address'   => 'required|string',
            'permanent_address' => 'nullable|string',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Save to private disk
        if ($request->hasFile('profile_photo')) {
            $fileName = time().'_'.uniqid().'.'.$request->profile_photo->extension();
            $path = $request->file('profile_photo')->storeAs('employees/photos', $fileName, 'private'); // private disk
            $data['profile_photo'] = $path; // e.g. employees/photos/...
        }

        if ($request->hasFile('document_file')) {
            $docName = time().'_'.uniqid().'_doc.'.$request->document_file->extension();
            $docPath = $request->file('document_file')->storeAs('employees/documents', $docName, 'private');
            $data['document_file'] = $docPath;
        }

        Employee::create($data);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    // edit form
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }

    // update
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $data = $request->validate([
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'designation'       => 'nullable|string',
            'email'             => ['required','email', Rule::unique('employees')->ignore($employee->id)],
            'salary'            => 'required|numeric',
            'phone'             => 'required|string',
            'emergency_phone'   => 'nullable|string',
            'nid_number'        => 'required|string',
            'present_address'   => 'required|string',
            'permanent_address' => 'nullable|string',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Replace profile photo
        if ($request->hasFile('profile_photo')) {
            // delete old if exists
            if ($employee->profile_photo && Storage::disk('private')->exists($employee->profile_photo)) {
                Storage::disk('private')->delete($employee->profile_photo);
            }
            $fileName = time().'_'.uniqid().'.'.$request->profile_photo->extension();
            $path = $request->file('profile_photo')->storeAs('employees/photos', $fileName, 'private');
            $data['profile_photo'] = $path;
        }

        // Replace document
        if ($request->hasFile('document_file')) {
            if ($employee->document_file && Storage::disk('private')->exists($employee->document_file)) {
                Storage::disk('private')->delete($employee->document_file);
            }
            $docName = time().'_'.uniqid().'_doc.'.$request->document_file->extension();
            $docPath = $request->file('document_file')->storeAs('employees/documents', $docName, 'private');
            $data['document_file'] = $docPath;
        }

        $employee->update($data);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->profile_photo && Storage::disk('private')->exists($employee->profile_photo)) {
            Storage::disk('private')->delete($employee->profile_photo);
        }

        if ($employee->document_file && Storage::disk('private')->exists($employee->document_file)) {
            Storage::disk('private')->delete($employee->document_file);
        }

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }

    /**
     * Serve or download a file from private storage.
     * type: 'photo' or 'document'
     * query param ?download=1 forces download (otherwise images are shown inline)
     */
    public function getFile(Request $request, $type, $id)
    {
        $employee = Employee::findOrFail($id);

        if ($type === 'photo') {
            $path = $employee->profile_photo;
        } elseif ($type === 'document') {
            $path = $employee->document_file;
        } else {
            abort(404);
        }

        if (!$path || !Storage::disk('private')->exists($path)) {
            abort(404);
        }

        // Force download if requested or if document is not an image
        $download = $request->query('download');

        $mime = Storage::disk('private')->mimeType($path);

        if ($download) {
            return Storage::disk('private')->download($path);
        }

        // If it's an image, show inline; otherwise force download
        if (str_starts_with($mime, 'image/')) {
            $contents = Storage::disk('private')->get($path);
            return response($contents, 200)->header('Content-Type', $mime);
        }

        return Storage::disk('private')->download($path);
    }
}
