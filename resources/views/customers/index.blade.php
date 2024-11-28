@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Customers</h1>
    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Customer</a>
</div>
<table class="min-w-full bg-white border border-gray-200">
    <thead>
        <tr>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Phone</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td class="px-4 py-2 border">{{ $customer->name }}</td>
            <td class="px-4 py-2 border">{{ $customer->email }}</td>
            <td class="px-4 py-2 border">{{ $customer->phone }}</td>
            <td class="px-4 py-2 border">
                <a href="{{ route('customers.edit', $customer) }}" class="text-blue-500">Edit</a> |
                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $customers->links() }}
@endsection
