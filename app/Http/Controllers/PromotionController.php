<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Promotion;
use App\Models\SalaryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    // Show all employees for promotion
    public function index()
    {
        $employees = Employee::orderBy('first_name')->get();
        return view('promotions.index', compact('employees'));
    }

    // Show form to create promotion for a specific employee
    public function create(Employee $employee)
    {
        return view('promotions.create', compact('employee'));
    }

    // Store promotion and update salary + history + designation
    public function store(Request $request, Employee $employee)
{
    $data = $request->validate([
        'increment_type'   => 'nullable|in:amount,percent',
        'increment_value'  => 'nullable|numeric|min:0.01',
        'effective_date' => 'nullable|date|after_or_equal:today',
        'note'             => 'nullable|string|max:2000',
        'new_designation'  => 'nullable|string|max:255',
    ]);

    DB::transaction(function () use ($employee, $data) {
        $employee = Employee::where('id', $employee->id)->lockForUpdate()->first();

        $oldSalary = (float) $employee->salary;
        $oldDesignation = $employee->designation;

        // Calculate increment only if provided
        $increment_amount = 0;
        $newSalary = $oldSalary;

        if (!empty($data['increment_value'])) {
            if ($data['increment_type'] === 'percent') {
                $increment_amount = round($oldSalary * ($data['increment_value']/100), 2);
            } else {
                $increment_amount = round($data['increment_value'], 2);
            }
            $newSalary = round($oldSalary + $increment_amount, 2);
        }

        $newDesignation = $data['new_designation'] ?? $oldDesignation;

        // Create promotion record
        Promotion::create([
            'employee_id'       => $employee->id,
            'old_salary'        => $oldSalary,
            'increment_type'    => $data['increment_type'] ?? null,
            'increment_value'   => $data['increment_value'] ?? null,


            'increment_amount'  => $increment_amount,
            'new_salary'        => $newSalary,
            'old_designation'   => $oldDesignation,
            'new_designation'   => $newDesignation,
            'effective_date'    => $data['effective_date'] ?? now()->toDateString(),
            'note'              => $data['note'] ?? null,
            'created_by'        => Auth::id(),
        ]);

        // Update salary history only if increment
        if ($increment_amount > 0) {
            SalaryHistory::create([
                'employee_id' => $employee->id,
                'amount' => $newSalary,
                'reason' => 'Promotion Increment',
                'effective_date' => $data['effective_date'] ?? now()->toDateString(),
            ]);
        }

        // Update employee
        $employee->salary = $newSalary;
        $employee->designation = $newDesignation;
        $employee->save();
    });

    return redirect()
        ->route('promotions.index')->with('success', 'Promotion applied successfully.');

}


    // Show employee promotion history
    public function history(Employee $employee)
    {
        $promotions = $employee->promotions()->orderBy('created_at','desc')->get();
        return view('promotions.history', compact('employee','promotions'));
    }
}
