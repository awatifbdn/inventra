<x-layouts.app :title="__('Orders')">
    <!-- 📦 Summary Cards -->
    @php
        $summaryCards = [
            ['title' => 'Total Orders', 'value' => $orders->total(), 'note' => 'Updated daily', 'color' => '#c6e6fc', 'textColor' => '#1d4ed8'],
            ['title' => 'Paid Orders', 'value' => $orders->where('status', 'paid')->count(), 'note' => 'Up by 12%', 'color' => '#fff2cc', 'textColor' => '#16a34a'],
            ['title' => 'Pending Orders', 'value' => $orders->where('status', 'pending')->count(), 'note' => 'Check pending payments', 'color' => '#fcd9be', 'textColor' => '#f59e0b'],
            ['title' => 'Completed Orders', 'value' => $orders->where('status', 'completed')->count(), 'note' => 'All shipped', 'color' => '#d5fbd1', 'textColor' => '#0ea5e9'],
        ];
    @endphp

    <div class="flex flex-col gap-6">
        <!-- 📦 Summary Cards -->
        <div class="flex flex-wrap gap-6 justify-center">
            @foreach ($summaryCards as $card)
                <div class="w-full sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-0.75rem)]">
                    <div style="
                        background: linear-gradient(180deg, #ffffff, {{ $card['color'] }});
                        border-radius: 1rem;
                        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
                        padding: 1.5rem;
                        min-height: 150px;
                        transition: transform 0.3s, box-shadow 0.3s;
                    "
                    onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.12)'"
                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.08)'">
                        <h2 class="text-lg font-semibold text-gray-700">{{ $card['title'] }}</h2>
                        <p class="text-2xl font-bold mt-2" style="color: {{ $card['textColor'] }}">
                            {{ number_format($card['value']) }}
                        </p>
                        <p class="text-sm mt-1 text-gray-500">{{ $card['note'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

       <!-- 🗂 Animated Underline Navigation Tabs -->
        <div class="relative border-b border-gray-200 mt-8">
            <nav id="tabsNav" class="flex space-x-6 overflow-x-auto no-scrollbar relative" aria-label="Tabs">
                @php
                    // Count of new orders for Inbox badge
                    $newOrdersCount = \App\Models\Order::where('status', 'new')->count();
                @endphp

                @foreach ([
                    'all' => 'All Orders',
                    'inbox' => 'Inbox',
                    'pending' => 'Pending',
                    'paid' => 'Paid',
                    'completed' => 'Completed'
                ] as $key => $label)

                    <button 
                        onclick="switchTab('{{ $key }}', this)"
                        id="tab-{{ $key }}"
                        class="whitespace-nowrap py-3 px-4 text-sm font-medium focus:outline-none relative
                            text-gray-500 hover:text-yellow-600 transition-colors duration-200 ease-in-out"
                    >
                        {{ $label }}

                        @if ($key === 'inbox' && $newOrdersCount > 0)
                            <span class="absolute -top-1 -right-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                                {{ $newOrdersCount }}
                            </span>
                        @endif
                    </button>

                @endforeach

                <!-- Animated Underline -->
                <span id="activeTabIndicator" class="absolute bottom-0 h-0.5 bg-yellow-500 transition-all duration-300 ease-in-out rounded"></span>
            </nav>
        </div>



        <!-- 📋 Tab Content -->
        <div id="ordersContent" class="overflow-x-auto rounded-lg shadow mt-4">
            <div class="text-center py-6 text-gray-400">Loading...</div>
        </div>
    </div>

    <!-- JS -->
    <script>
        let activeTab = 'all';

        document.addEventListener('DOMContentLoaded', () => {
            switchTab('all'); // Load default tab
        });

        function switchTab(tab) {
            activeTab = tab;

            // Update tab styles
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('border-yellow-500', 'text-yellow-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById(`tab-${tab}`);
            activeBtn.classList.add('border-yellow-500', 'text-yellow-600');

            // Load content
            loadTabContent(tab);
        }



        function switchTab(tab) {
                activeTab = tab;

                // Update tab styles
                document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                    btn.classList.remove('border-yellow-500', 'text-yellow-600');
                    btn.classList.add('text-gray-500');
                });
                document.getElementById(`tab-${tab}`).classList.add('border-yellow-500', 'text-yellow-600');

                // Load content
                loadTabContent(tab);
            }

            function loadTabContent(tab, params = '') {
                const content = document.getElementById('ordersContent');
                content.innerHTML = '<div class="text-center py-6 text-gray-400">Loading...</div>';

                fetch(`/admin/orders/tab/${tab}${params}`)
                    .then(response => response.text())
                    .then(html => {
                        content.innerHTML = html;

                        // Attach submit listener to this tab's search form
                        const form = document.getElementById(`searchForm-${tab}`);
                        if (form) {
                            form.addEventListener('submit', function (e) {
                                e.preventDefault();
                                const formData = new FormData(form);
                                const queryString = new URLSearchParams(formData).toString();
                                loadTabContent(tab, `?${queryString}`);
                            });
                        }
                    });
            }

    </script>
</x-layouts.app>
