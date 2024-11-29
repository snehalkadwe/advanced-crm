<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-xl font-bold mb-4">Edit Sale</h1>

                    <form action="{{ route('sales.update', $sale) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Customer Selection -->
                        <div class="mb-4">
                            <label for="customer_id" class="block text-sm font-bold mb-2">Customer</label>
                            <select name="customer_id" id="customer_id" class="w-full border-gray-300 rounded">
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @if($sale->customer_id == $customer->id)
                                    selected @endif>
                                    {{ $customer->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="product_name" class="block text-sm font-bold mb-2">Product Name</label>
                            <input type="text" name="product_name" id="product_name"
                                value="{{ old('product_name', $sale->product_name) }}"
                                class="w-full border-gray-300 rounded">
                            @error('product_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-bold mb-2">Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $sale->amount) }}"
                                class="w-full border-gray-300 rounded" step="0.01">
                            @error('amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Update Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
