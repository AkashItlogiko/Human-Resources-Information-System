<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

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
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $fileName = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->move(public_path('employees'), $fileName);
            $data['profile_photo'] = $fileName;
        }

        Employee::create($data);

        return redirect()->route('employee.index')
                         ->with('success', 'Employee created successfully');
    }

    // ------------------ Edit Function ------------------
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
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $fileName = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->move(public_path('employees'), $fileName);
            $data['profile_photo'] = $fileName;
        }

        $employee->update($data);

        return redirect()->route('employee.index')
                         ->with('success', 'Employee updated successfully');
    }

//  Delete Function
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);


        if($employee->profile_photo && file_exists(public_path('employees/' . $employee->profile_photo))){
            unlink(public_path('employees/' . $employee->profile_photo));
        }

        $employee->delete();

        return redirect()->route('employee.index')
                         ->with('success', 'Employee deleted successfully');
    }
}
