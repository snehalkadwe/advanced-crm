<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

                        <!-- Customer Details -->
                        <h1 class="text-xl font-bold mb-6">Customer Details</h1>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Name</h2>
                            <p class="text-lg text-gray-900">{{ $customer->name }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Email</h2>
                            <p class="text-lg text-gray-900">{{ $customer->email }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Phone</h2>
                            <p class="text-lg text-gray-900">{{ $customer->phone }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Created At</h2>
                            <p class="text-lg text-gray-900">{{ $customer->created_at->format('F d, Y h:i A') }}</p>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-sm font-medium text-gray-700">Last Updated</h2>
                            <p class="text-lg text-gray-900">{{ $customer->updated_at->format('F d, Y h:i A') }}</p>
                        </div>

                        <!-- Sales Associated with Customer -->
                        <h2 class="text-xl font-bold mt-6 mb-4">Associated Sales</h2>

                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border">Product Name</th>
                                    <th class="px-4 py-2 border">Amount</th>
                                    <th class="px-4 py-2 border">Date</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customer->sales as $sale)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $sale->product_name }}</td>
                                    <td class="px-4 py-2 border">${{ number_format($sale->amount, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $sale->created_at->format('F d, Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        <a href="{{ route('sales.show', $sale) }}" class="text-blue-500">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center px-4 py-2 border text-gray-600">
                                        No sales found for this customer.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Back Button -->
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('customers.index') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-400">
                                Back to Customers
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
