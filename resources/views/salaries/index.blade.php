@extends('layouts.app')
@section('content')

<h1 class="text-2xl font-bold mb-4">Employee Salary Disbursement</h1>

@if(session('success'))
<div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('salaries.disburse') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="font-bold">Disburse Date</label>
        <input type="date" name="disburse_date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required class="border p-2 rounded">
    </div>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="py-2 px-4"><input type="checkbox" id="select-all"></th>
                <th class="py-2 px-4">Employee Name</th>
                <th class="py-2 px-4">Current Salary</th>
                <th class="py-2 px-4">History</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <tr class="border-b">
                <td class="py-2 px-4">
                    <input type="checkbox" name="employee_ids[]" value="{{ $employee->id }}">
                </td>
                <td class="py-2 px-4">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td class="py-2 px-4">{{ number_format($employee->salary, 2) }}</td>
                <td class="py-2 px-4">
                    <a href="{{ route('salaries.history', $employee->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">History</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded">Disburse Selected</button>
</form>

<script>
document.getElementById('select-all').addEventListener('click', function() {
    const checkboxes = document.querySelectorAll('input[name="employee_ids[]"]');
    checkboxes.forEach(cb => cb.checked = this.checked);
});
</script>

@endsection
