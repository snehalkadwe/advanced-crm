<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Recycle Bin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Sales Recycle Bin</h1>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Customer</th>
                                <th class="px-4 py-2 border">Product Name</th>
                                <th class="px-4 py-2 border">Amount</th>
                                <th class="px-4 py-2 border">Deleted At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deletedSales as $sale)
                            <tr>
                                <td class="px-4 py-2 border">{{ $sale->customer->name }}</td>
                                <td class="px-4 py-2 border">{{ $sale->product_name }}</td>
                                <td class="px-4 py-2 border">${{ number_format($sale->amount, 2) }}</td>
                                <td class="px-4 py-2 border">{{ $sale->deleted_at->format('F d, Y h:i A') }}</td>
                                <td class="px-4 py-2 border">
                                    <form action="{{ route('sales.restore', $sale->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:underline">Restore</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-2 border text-gray-600">No deleted sales
                                    found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $deletedSales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
