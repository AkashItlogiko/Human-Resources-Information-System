<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('first_name')->get();
        return view('promotions.index', compact('employees'));
    }

    public function create(Employee $employee)
    {
        return view('promotions.create', compact('employee'));
    }

    public function store(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'increment_type' => 'required|in:amount,percent',
            'increment_value' => 'required|numeric|min:0.01',
            'effective_date' => 'nullable|date',
            'note' => 'nullable|string|max:2000',
        ]);

        DB::transaction(function () use ($employee, $data) {
            $employee = Employee::where('id', $employee->id)->lockForUpdate()->first();
            $old = (float) $employee->salary;

            if ($data['increment_type'] === 'percent') {
                $increment_amount = round($old * ($data['increment_value'] / 100), 2);
            } else {
                $increment_amount = round($data['increment_value'], 2);
            }

            $new_salary = round($old + $increment_amount, 2);

            Promotion::create([
                'employee_id' => $employee->id,
                'old_salary' => $old,
                'increment_type' => $data['increment_type'],
                'increment_value' => $data['increment_value'],
                'increment_amount' => $increment_amount,
                'new_salary' => $new_salary,
                'effective_date' => $data['effective_date'] ?? now()->toDateString(),
                'note' => $data['note'] ?? null,
                'created_by' => Auth::id(),
            ]);

            $employee->salary = $new_salary;
            $employee->save();
        });

        return redirect()->route('promotions.index')->with('success', 'Promotion applied and salary updated.');
    }

    public function history(Employee $employee)
    {
        $promotions = $employee->promotions()->orderBy('created_at','desc')->get();
        return view('promotions.history', compact('employee','promotions'));
    }
}
