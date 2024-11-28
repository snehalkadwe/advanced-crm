@extends('layouts.app')

@section('title', 'Sales')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Sales</h1>
    <a href="{{ route('sales.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Sale</a>
</div>

<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="px-4 py-2 border">Customer</th>
            <th class="px-4 py-2 border">Product Name</th>
            <th class="px-4 py-2 border">Amount</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
        <tr>
            <td class="px-4 py-2 border">{{ $sale->customer->name }}</td>
            <td class="px-4 py-2 border">{{ $sale->product_name }}</td>
            <td class="px-4 py-2 border">${{ number_format($sale->amount, 2) }}</td>
            <td class="px-4 py-2 border">
                <a href="{{ route('sales.edit', $sale) }}" class="text-blue-500">Edit</a> |
                <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $sales->links() }}
@endsection
