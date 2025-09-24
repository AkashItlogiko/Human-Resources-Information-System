@extends('layouts.app')
@section('content')
<div class="p-6 max-w-3xl mx-auto">
   <h2 class="text-xl font-bold mb-4">
    Promotion History: {{ $employee->first_name }} {{ $employee->last_name }}
</h2>


    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-50">
                <th class="p-2 text-left">Date</th>
                <th class="p-2 text-left">Old Salary</th>
                <th class="p-2 text-left">Increment</th>
                <th class="p-2 text-left">New Salary</th>
                <th class="p-2 text-left">Old Desig.</th>
                <th class="p-2 text-left">New Desig.</th>
                <th class="p-2 text-left">Type</th>
                <th class="p-2 text-left">Note</th>
                <th class="p-2 text-left">By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->effective_date ?? $p->created_at->format('Y-m-d') }}</td>
                    <td class="p-2">৳ {{ number_format($p->old_salary,2) }}</td>
                    <td class="p-2">৳ {{ number_format($p->increment_amount,2) }} ({{ $p->increment_value }}{{ $p->increment_type === 'percent' ? '%' : '' }})</td>
                    <td class="p-2">৳ {{ number_format($p->new_salary,2) }}</td>
                    <td class="p-2">{{ $p->old_designation ?? '—' }}</td>
                    <td class="p-2">{{ $p->new_designation ?? '—' }}</td>
                    <td class="p-2">{{ ucfirst($p->increment_type) }}</td>
                    <td class="p-2">{{ $p->note }}</td>
                    <td class="p-2">{{ $p->creator->name ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
