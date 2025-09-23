@extends('layouts.app')
@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Give Promotion: {{ $employee->first_name }} {{ $employee->last_name }}</h2>

    <div class="mb-4">
        <div>Current Salary: <strong>৳ <span id="old_salary_display">{{ number_format($employee->salary ?? 0,2) }}</span></strong></div>
        <div>Current Designation: <strong>{{ $employee->designation ?? '—' }}</strong></div>
    </div>

    <form action="{{ route('promotions.store', $employee) }}" method="POST" id="promoForm">
        @csrf
        <input type="hidden" id="old_salary" value="{{ $employee->salary ?? 0 }}">

        <div class="mb-3">
            <label class="block mb-1">Increase Type <small>(Optional)</small></label>
            <label><input type="radio" name="increment_type" value="amount" checked> Fixed Amount</label>
            <label class="ml-4"><input type="radio" name="increment_type" value="percent"> Percent (%)</label>
        </div>

        <div class="mb-3">
            <label class="block mb-1">Value (amount or percent) <small>(Optional)</small></label>
            <input type="number" step="0.01" min="0" name="increment_value" id="increment_value" class="w-full p-2 border rounded" placeholder="Leave blank if no salary change">
        </div>

        <div class="mb-3">
            <label>Calculated Increment (৳)</label>
            <div id="increment_amount_display" class="p-2 bg-gray-50 rounded">৳ 0.00</div>
        </div>

        <div class="mb-3">
            <label>New Salary</label>
            <div id="new_salary_display" class="p-2 bg-gray-50 rounded">৳ {{ number_format($employee->salary ?? 0,2) }}</div>
        </div>

        <div class="mb-3">
            <label class="block mb-1">New Designation <small>(Optional)</small></label>
            <input type="text" name="new_designation" class="w-full p-2 border rounded" value="{{ old('new_designation', $employee->designation) }}" placeholder="Leave blank to keep current designation">
        </div>

        <div class="mb-3">
    <label>Effective Date</label>
   <input
    type="date"
    name="effective_date"
    class="w-full p-2 border rounded"
    min="{{ date('Y-m-d') }}"
    value="{{ old('effective_date', $employee->effective_date ?? date('Y-m-d')) }}"
>

</div>


        <div class="mb-3">
            <label>Note</label>
            <textarea name="note" class="w-full p-2 border rounded"></textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Apply Promotion</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const oldSalary = parseFloat(document.getElementById('old_salary').value) || 0;
    const typeRadios = document.querySelectorAll('input[name="increment_type"]');
    const valueInput = document.getElementById('increment_value');
    const incDisplay = document.getElementById('increment_amount_display');
    const newDisplay = document.getElementById('new_salary_display');

    function getType() {
        return document.querySelector('input[name="increment_type"]:checked').value;
    }

    function calculate() {
        const type = getType();
        const val = parseFloat(valueInput.value) || 0;
        let inc = 0;
        if (val > 0) {
            if (type === 'percent') {
                inc = +(oldSalary * (val / 100));
            } else {
                inc = +val;
            }
        }
        inc = Math.round((inc + Number.EPSILON) * 100) / 100;
        const newSalary = Math.round((oldSalary + inc + Number.EPSILON) * 100) / 100;
        incDisplay.textContent = '৳ ' + inc.toFixed(2);
        newDisplay.textContent = '৳ ' + newSalary.toFixed(2);
    }

    valueInput.addEventListener('input', calculate);
    typeRadios.forEach(r => r.addEventListener('change', calculate));
});
</script>
@endsection
