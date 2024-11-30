<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
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
                    <div class="flex justify-between mb-4">
                        <h1 class="text-2xl font-bold">Sales</h1>
                        <div>
                            <!-- Search Form -->
                            <form action="{{ route('sales.index') }}" method="GET" class="inline">
                                <input type="text" name="search" placeholder="Search Sales..."
                                    value="{{ request('search') }}"
                                    class="border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                            </form>
                            <a href="{{ route('sales.create') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Add Sales</a>
                            <a href="{{ route('sales.recycle-bin') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Recycle Bin</a>
                        </div>
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
                                    <a href="{{ route('sales.show', $sale) }}" class="text-blue-500">View</a> |
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
                    <div class="mt-5">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
