<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- sales manager role --}}
            @if(auth()->user()->role == 'admin')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Date Range Filter -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex items-center space-x-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Filter</button>
                    </div>
                </form>

                <!-- Total Customers and Sales Value -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium">Total Customers</h3>
                        <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium">Total Sales Value</h3>
                        <p class="text-2xl font-bold">${{ number_format($totalSalesValue, 2) }}</p>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium mb-4">Monthly Sales Trends</h3>
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium mb-4">Top 5 Customers</h3>
                        <canvas id="topCustomersChart"></canvas>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Date Range Filter -->
                <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex items-center space-x-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">Filter</button>
                    </div>
                </form>
                <!-- Total Customers and Sales Value -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium">Total Sales Value</h3>
                        <p class="text-2xl font-bold">${{ number_format($totalSalesValue, 2) }}</p>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">
                    <div class="bg-gray-100 p-4 rounded shadow">
                        <h3 class="text-lg font-medium mb-4">Monthly Sales Trends</h3>
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Monthly Sales Trends Chart
        const salesTrendCtx = document.getElementById('salesTrendChart').getContext('2d');
        const salesTrendData = @json($monthlySalesTrends);
        const salesTrendLabels = salesTrendData.map(data => data.month);
        const salesTrendValues = salesTrendData.map(data => data.total);

        new Chart(salesTrendCtx, {
            type: 'line',
            data: {
                labels: salesTrendLabels, // X-axis labels
                datasets: [{
                    label: 'Sales ($)',
                    data: salesTrendValues, // Y-axis data
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Sales Value ($)'
                        }
                    }
                }
            }
        });

        // Top 5 Customers Chart
        const topCustomersCtx = document.getElementById('topCustomersChart').getContext('2d');
        const topCustomersData = @json($topCustomers);
        const topCustomerLabels = topCustomersData.map(data => data.name);
        const topCustomerValues = topCustomersData.map(data => data.total_sales);

        new Chart(topCustomersCtx, {
            type: 'bar',
            data: {
                labels: topCustomerLabels, // X-axis labels
                datasets: [{
                    label: 'Total Sales ($)',
                    data: topCustomerValues, // Y-axis data
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Customer'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Sales ($)'
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
