<!-- resources/views/customers/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
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
                        <h1 class="text-2xl font-bold">Customers</h1>
                        <div>
                            <a href="{{ route('customers.create') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Add Customer</a>
                            <a href="{{ route('customers.recycle-bin') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded">Recycle Bin</a>
                        </div>
                    </div>

                    <!-- Customers Table -->
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
                                    <a href="{{ route('customers.show', $customer) }}" class="text-blue-500">View</a> |
                                    <a href="{{ route('customers.edit', $customer) }}" class="text-blue-500">Edit</a> |
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
