<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryHistory;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    // Salary List + Disburse Form
    public function index()
    {
        $employees = Employee::orderBy('first_name')->get();
        return view('salaries.index', compact('employees'));
    }

    // Salary Disburse (bulk or individual)
    public function disburse(Request $request)
    {
        $request->validate([
            'employee_ids' => 'required|array',
            'disburse_date' => 'required|date',
        ]);

        $employees = Employee::whereIn('id', $request->employee_ids)->get();

        foreach($employees as $employee) {


            

            // Insert salary history
            SalaryHistory::create([
                'employee_id' => $employee->id,
                'amount' => $employee->salary,
                'reason' => 'Salary Disbursement',
                'effective_date' => $request->disburse_date,
            ]);
        }

        return redirect()->back()->with('success','Salary disbursed successfully.');
    }

    // Employee Salary History
    public function history(Employee $employee)
    {
        $histories = $employee->salaryHistories()->orderBy('effective_date','desc')->get();
        return view('salaries.history', compact('employee','histories'));
    }
}
