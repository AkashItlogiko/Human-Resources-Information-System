@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Employee Promotions</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-50">
                <th class="p-3 text-left">No</th>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Current Salary</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $i => $emp)
            <tr class="border-t">
                <td class="p-3">{{ $i+1 }}</td>
                <td class="p-3">{{ $emp->first_name }} {{ $emp->last_name }}</td>
                <td class="p-3">৳ {{ number_format($emp->salary,2) }}</td>
                <td class="p-3">
                    <a href="{{ route('promotions.create', $emp) }}" class="px-3 py-1 bg-blue-600 text-white rounded mr-2">Give Promotion</a>
                    <a href="{{ route('promotions.history', $emp) }}" class="px-3 py-1 bg-gray-600 text-white rounded">History</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
