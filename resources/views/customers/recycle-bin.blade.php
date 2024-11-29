<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recycle Bin') }}
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
                        <h1 class="text-2xl font-bold">Recycle Bin</h1>
                        <a href="{{ route('customers.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back
                            to Customers</a>
                    </div>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Phone</th>
                                <th class="px-4 py-2 border">Deleted At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deletedCustomers as $customer)
                            <tr>
                                <td class="px-4 py-2 border">{{ $customer->name }}</td>
                                <td class="px-4 py-2 border">{{ $customer->email }}</td>
                                <td class="px-4 py-2 border">{{ $customer->phone }}</td>
                                <td class="px-4 py-2 border">{{ $customer->deleted_at->format('F d, Y h:i A') }}</td>
                                <td class="px-4 py-2 border">
                                    <!-- Restore Form -->
                                    <form action="{{ route('customers.restore', $customer->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:underline">Restore</button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-2 border text-gray-600">
                                    No deleted customers found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $deletedCustomers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
