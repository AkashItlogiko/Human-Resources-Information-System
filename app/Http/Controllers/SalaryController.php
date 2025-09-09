<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryHistory;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // Salary List
    public function index()
    {
        $employees = Employee::with('promotions')->orderBy('first_name')->get();
        return view('salaries.index', compact('employees'));
    }

    // Create Salary (Form)
    public function create(Employee $employee)
    {
        return view('salaries.create', compact('employee'));
    }

    // Store Salary
    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date'
        ]);

        // Employee table  update
        $employee->salary = $request->amount;
        $employee->save();

        // History  Insert
        SalaryHistory::create([
            'employee_id' => $employee->id,
            'amount' => $request->amount,
            'reason' => 'Manual Salary Entry',
            'effective_date' => $request->effective_date
        ]);

        return redirect()->route('salaries.index')->with('success','Salary added successfully.');
    }

    // Edit Salary
    public function edit(Employee $employee)
    {
        return view('salaries.edit', compact('employee'));
    }

    // Update Salary
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date'
        ]);

        $employee->update(['salary' => $request->amount]);

        SalaryHistory::create([
            'employee_id' => $employee->id,
            'amount' => $request->amount,
            'reason' => 'Salary Updated',
            'effective_date' => $request->effective_date
        ]);

        return redirect()->route('salaries.index')->with('success','Salary updated.');
    }

    

    // Employee Salary History
    public function history(Employee $employee)
    {
        $histories = SalaryHistory::where('employee_id',$employee->id)
            ->orderBy('created_at','desc')
            ->get();
        return view('salaries.history', compact('employee','histories'));
    }


}

