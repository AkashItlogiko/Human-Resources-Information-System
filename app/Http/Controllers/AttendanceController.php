<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Show form
    public function index()
    {
        $employees = Employee::all();
        return view('attendance.index', compact('employees'));
    }

    // Store Attendance
    public function store(Request $request)
    {
        foreach ($request->employee_id as $key => $employee_id) {
            Attendance::create([
                'employee_id' => $employee_id,
                'date' => $request->date,
                'status' => $request->status[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Attendance submitted successfully!');
    }

    // Edit Form  
public function edit($id)
{
    $attendance = Attendance::findOrFail($id);
    $employees = Employee::all();
    return view('attendance.edit', compact('attendance', 'employees'));
}

// Update Attendance
public function update(Request $request, $id)
{
    $attendance = Attendance::findOrFail($id);

    $attendance->update([
        'employee_id' => $request->employee_id,
        'date' => $request->date,
        'status' => $request->status,
    ]);

    return redirect()->route('attendance.history')->with('success', 'Attendance updated successfully!');
}

// Delete Attendance
public function destroy($id)
{
    $attendance = Attendance::findOrFail($id);
    $attendance->delete();

    return redirect()->route('attendance.history')->with('success', 'Attendance deleted successfully!');
}

    // Attendance History with filter
    public function history(Request $request)
    {
        $employees = Employee::all();
        $query = Attendance::with('employee');

        if ($request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }
        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $attendances = $query->get();

        return view('attendance.history', compact('employees', 'attendances'));
    }
}
