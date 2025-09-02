<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
        public function index() {
            $employees = Employee::all(); // Employee model থেকে সব data
            return view('employees.index', compact('employees'));
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
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $fileName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/employees'), $fileName);
            $data['photo'] = 'uploads/employees/'.$fileName;
        }

        Employee::create($data);

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully');
    }
}
