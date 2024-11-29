<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sale Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

                        <!-- Sale Details -->
                        <h1 class="text-xl font-bold mb-6">Sale Details</h1>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Customer</h2>
                            <p class="text-lg text-gray-900">{{ $sale->customer->name }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Product Name</h2>
                            <p class="text-lg text-gray-900">{{ $sale->product_name }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Amount</h2>
                            <p class="text-lg text-gray-900">${{ number_format($sale->amount, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Created At</h2>
                            <p class="text-lg text-gray-900">{{ $sale->created_at->format('F d, Y h:i A') }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Last Updated</h2>
                            <p class="text-lg text-gray-900">{{ $sale->updated_at->format('F d, Y h:i A') }}</p>
                        </div>

                        <!-- Back Button -->
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('sales.index') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-400">
                                Back to Sales
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
