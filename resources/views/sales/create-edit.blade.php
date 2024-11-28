@extends('layouts.app')

@section('title', $sale ?? 'Add Sale')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">{{ isset($sale) ? 'Edit Sale' : 'Add Sale' }}</h1>

    <form action="{{ isset($sale) ? route('sales.update', $sale) : route('sales.store') }}" method="POST">
        @csrf
        @isset($sale)
        @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-bold mb-2">Customer</label>
            <select name="customer_id" id="customer_id" class="w-full border-gray-300 rounded">
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" @if(isset($sale) && $sale->customer_id == $customer->id) selected
                    @endif>
                    {{ $customer->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="product_name" class="block text-sm font-bold mb-2">Product Name</label>
            <input type="text" name="product_name" id="product_name"
                value="{{ $sale->product_name ?? old('product_name') }}" class="w-full border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="amount" class="block text-sm font-bold mb-2">Amount</label>
            <input type="number" name="amount" id="amount" value="{{ $sale->amount ?? old('amount') }}"
                class="w-full border-gray-300 rounded" step="0.01">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ isset($sale) ? 'Update Sale' : 'Add Sale' }}
            </button>
        </div>
    </form>
</div>
@endsection
