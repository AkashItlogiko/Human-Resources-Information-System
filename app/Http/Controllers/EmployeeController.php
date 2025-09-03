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
        return view('employees.create');
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

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully');
    }
}
