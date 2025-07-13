<x-layouts.app :title="__('Dashboard')">
<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <div class="grid gap-6 md:grid-cols-3">
        <!-- 📦 Quick Actions -->
        <div class="relative rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4 shadow-sm h-full">
            <h4 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-100">Quick Actions</h4>
<div class="flex flex-wrap justify-center gap-6">
    <a href="#"
       class="flex items-center justify-center w-28 h-28 rounded-lg bg-yellow-200 text-yellow-700 shadow-md hover:shadow-lg hover:scale-110 transition-transform text-center text-sm font-medium">
        Add Product
    </a>
    <a href="#"
       class="flex items-center justify-center w-28 h-28 rounded-lg bg-blue-200 text-blue-700 shadow-md hover:shadow-lg hover:scale-110 transition-transform text-center text-sm font-medium">
        Pending Orders
    </a>
    <a href="#"
       class="flex items-center justify-center w-28 h-28 rounded-lg bg-green-200 text-green-700 shadow-md hover:shadow-lg hover:scale-110 transition-transform text-center text-sm font-medium">
        View Inventory
    </a>
    <a href="#"
       class="flex items-center justify-center w-28 h-28 rounded-lg bg-purple-200 text-purple-700 shadow-md hover:shadow-lg hover:scale-110 transition-transform text-center text-sm font-medium">
        Update Stock
    </a>
</div>


        </div>

        <!-- 📊 Inventory Breakdown -->
        <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4 shadow-sm h-[400px]">
            <h4 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100"> Inventory by Category</h4>
            <canvas id="inventoryChart" class="rounded"></canvas>
        </div>

        <!-- 📈 Sales Trend -->
        <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4 shadow-sm h-[400px]">
            <h4 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Sales Trend</h4>
            <canvas id="salesChart" class="rounded"></canvas>
        </div>
    </div>

    <!-- 🛒 Recent Orders -->
    <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-4 shadow-sm">
        <h4 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100"> Recent Orders</h4>
        <div class="overflow-x-auto rounded-lg">
            <table class="w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-neutral-700 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left">Order ID</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-800 divide-y divide-gray-100 dark:divide-gray-700">
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                        <td class="px-4 py-3">#ORD12345</td>
                        <td class="px-4 py-3">John Doe</td>
                        <td class="px-4 py-3">RM120.50</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium"
                                style="background-color: #FFF8E1; color: #FF9800;">Pending</span>
                        </td>
                        <td class="px-4 py-3">2025-07-10</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                        <td class="px-4 py-3">#ORD12346</td>
                        <td class="px-4 py-3">Jane Smith</td>
                        <td class="px-4 py-3">RM250.00</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium"
                                style="background-color: #E8F5E9; color: #4CAF50;">Paid</span>
                        </td>
                        <td class="px-4 py-3">2025-07-09</td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700 transition">
                        <td class="px-4 py-3">#ORD12347</td>
                        <td class="px-4 py-3">Alice Lee</td>
                        <td class="px-4 py-3">RM78.90</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium"
                                style="background-color: #E3F2FD; color: #2196F3;">Completed</span>
                        </td>
                        <td class="px-4 py-3">2025-07-08</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');

        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jul 5', 'Jul 6', 'Jul 7', 'Jul 8', 'Jul 9', 'Jul 10'],
                datasets: [{
                    label: 'Orders',
                    data: [12, 19, 7, 15, 22, 18],
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });

        const inventoryChart = new Chart(inventoryCtx, {
            type: 'pie',
            data: {
                labels: ['Interior', 'Exterior', 'Waterproofing', 'Protective'],
                datasets: [{
                    label: 'Inventory',
                    data: [500, 320, 125, 80],
                    backgroundColor: ['#FF9800', '#4CAF50', '#2196F3', '#9C27B0']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</x-layouts.app>