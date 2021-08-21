<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-5 bg-white border-b border-gray-200">
                <div class="grid grid-cols-2">
                    <p class="font-medium text-xl">Grafik Penjualan</p>
                    <div class="flex justify-end">
                        <div class="w-40" x-data="{ open: false}" @click.away="open=false" @close.stop="open=false">
                            <button @click=" open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="options-menu" aria-expanded="true" aria-haspopup="true">
                                Opsi : {{$filter}}
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
                    <div wire:ignore>
                        {!! $chart->container() !!}
                    </div>
                    <div class="mx-5">
                        <p class="w-32 border-b-2 border-green-400 mb-2">Pendapatan</p>
                        <p>Total pendapatan: Rp. {{ number_format($total) }}</p>
                        <p>Pendapatan tertinggi: Rp. {{ number_format($high_income) }}</p>
                        <p class="w-32 border-b-2 border-green-400 mb-2 mt-2">Penjualan Barang</p>
                        <p>Jumlah barang terjual: {{ $tot_prod_sold }}</p>
                        <p>Penjualan barang tertinggi: {{ $qty_high_bundle_prod_sold }}</p>
                        <p>Produk dengan penjualan tertinggi: <b>{{$high_prod_name}}</b> [{{$qty_high_prod_sold}}]</p>
                        <p class="w-40 border-b-2 border-green-400 mb-2 mt-2">Penjualan Per Barang</p>
                        <ul>
                            @foreach($barang as $index=>$b)
                                <li>{{ $index+1 }}. {{$b['nama_produk']}} terjual {{$b['jumlah'] }} buah</li>
                            @endforeach
                        </ul>

                    </div>
                    <a href="{{url('/export')}}" class="bg-green-400 px-3 py-2 rounded m-2 w-36">Export Laporan</a>
                </div>

            </div>
        </div>
    </div>
    @if($chart)
        {!! $chart->script() !!}
    @endif
    <script>
        window.Livewire.on('labelsUpdated', data => {
            window.{{ $chart->id }}.data.labels = JSON.parse(data)
            window.{{ $chart->id }}.update()
        })

        window.Livewire.on('datasetsUpdated', data => {
            var data = JSON.parse(data)
            window.{{ $chart->id }}.data.datasets.forEach((dataset) => {
                dataset.data = data
            })
            window.{{ $chart->id }}.update()
        })
    </script>

</div>
