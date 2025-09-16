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
         $date = $request->date;

    foreach ($request->employee_id as $key => $employeeId) {
        $status = $request->status[$key];

        // Check duplicate (same employee + same date)
        $exists = Attendance::where('employee_id', $employeeId)
                            ->whereDate('date', $date)
                            ->exists();

        if (!$exists) {
            Attendance::create([
                'employee_id' => $employeeId,
                'date' => $date,
                'status' => $status,
            ]);
        }
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
        'status' => $request->status,
    ]);

    return redirect()->route('attendance.history')
                     ->with('success', 'Attendance status updated successfully!');
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
    // Fetch all employees for the dropdown
    $employees = Employee::orderBy('first_name')->get();

    // Start attendance query with employee relation
    $query = Attendance::with('employee');

    // Filter by employee if selected
    if ($request->employee_id) {
        $query->where('employee_id', $request->employee_id);
    }

    // Filter by month if selected
    if ($request->month) {
        $query->whereMonth('date', $request->month);
    }

    // Filter by year if selected
    if ($request->year) {
        $query->whereYear('date', $request->year);
    }

    // Get filtered attendance records
    $attendances = $query->get();

    // Pass employees and attendances to the view
    return view('attendance.history', compact('employees', 'attendances'));
}

}
