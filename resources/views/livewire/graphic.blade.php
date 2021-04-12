@php
$total = 0;
$harga = '';
$label = '';
$len = count($data);
$harga = '[';
$label = '[';
foreach ($data as $index => $dt)
    {
        $harga .= $dt->total;
        $label .= "'".\Carbon\Carbon::parse($dt->created_at)->format('H:s')."'";
        $total += $dt->total;
        if($index != $len - 1) {
            $harga.=',';
            $label.=',';
        }
    }
$harga .= ']';
$label .= ']';
@endphp
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-5 bg-white border-b border-gray-200">
                <div class="grid grid-cols-2">
                    <p class="font-medium text-xl">Grafik Penjualan</p>
                    <div class="flex justify-end">
                        <div class="w-24" x-data="{ open: false}" @click.away="open=false" @close.stop="open=false">
                            <button @click=" open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                                Options
                                <!-- Heroicon name: solid/chevron-down -->
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 mr-3 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <div class="py-1" role="none">
                                    <button @click="open=false" wire:click="changeFilter('now')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left" role="menuitem">Hari Ini</button>
                                    <button @click="open=false" wire:click="changeFilter('month')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full text-left" role="menuitem">Bulan Ini</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="mx-5">
                        <p class="font-bold">Total: Rp.{{ number_format($total) }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js"></script>
    <script>
        $(function ()
        {

            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! $label !!},
                    datasets: [{
                        label: 'Penjualan',
                        data: {{ $harga }},
                        backgroundColor: 'rgba(95,246,4,0.2)',
                        borderColor: 'rgb(40,165,7)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true
                }
            });

            $('.block').on('click', function ()
            {
                myChart.update();
            })
        })

    </script>
</div>
