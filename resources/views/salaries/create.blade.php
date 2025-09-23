{{-- @extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">
        Create Salary for {{ $employee->first_name }} {{ $employee->last_name }}
    </h1>

    <form action="{{ route('salaries.store', $employee->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
        @csrf
        <div class="mb-4">
            <label class="block font-medium">Salary Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium">Effective Date</label>
            <input type="date" name="effective_date" class="w-full border rounded p-2" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
    </form>
@endsection --}}
