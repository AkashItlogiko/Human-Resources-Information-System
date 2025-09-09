@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">
        Salary History of {{ $employee->first_name }} {{ $employee->last_name }}
    </h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Amount</th>
                <th class="py-2 px-4">Reason</th>
                <th class="py-2 px-4">Effective Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $index => $history)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $index + 1 }}</td>
                    <td class="py-2 px-4">{{ number_format($history->amount, 2) }}</td>
                    <td class="py-2 px-4">{{ $history->reason }}</td>
                    <td class="py-2 px-4">{{ $history->effective_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
