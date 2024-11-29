<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import / Export Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Row with two columns for Customers and Sales -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Customers Section -->
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-bold mb-4">Customer Data</h3>

                    <!-- Import Form for Customers -->
                    <form action="{{ route('customers.import') }}" method="POST" enctype="multipart/form-data"
                        class="mb-4">
                        @csrf
                        <div class="mb-4">
                            <label for="customer_import" class="block text-sm font-medium text-gray-700">Import
                                Customers (CSV or Excel)</label>
                            <input type="file" name="file" id="customer_import" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600">Import
                            Customers</button>
                    </form>

                    <!-- Export Button for Customers -->
                    <a href="{{ route('customers.export') }}"
                        class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Export
                        Customers</a>
                </div>

                <!-- Sales Section -->
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-xl font-bold mb-4">Sales Data</h3>

                    <!-- Import Form for Sales -->
                    <form action="{{ route('sales.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="mb-4">
                            <label for="sales_import" class="block text-sm font-medium text-gray-700">Import Sales (CSV
                                or Excel)</label>
                            <input type="file" name="file" id="sales_import" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600">Import
                            Sales</button>
                    </form>

                    <!-- Export Button for Sales -->
                    <a href="{{ route('sales.export') }}"
                        class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Export
                        Sales</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
