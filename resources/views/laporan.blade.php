<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan
        </h2>
    </x-slot>

    <livewire:graphic/>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
                    <table class="table my-2">
                        <thead class="bg-blue-500 text-white">
                        <tr>
                            <th scope="col" class="rounded-l-xl">#</th>
                            <th scope="col">List barang</th>
                            <th scope="col">Total</th>
                            <th scope="col" class="rounded-r-xl">Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $br)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>@foreach(json_decode($br->keranjang) as $list)
                                        - {{$list->nama_produk}} x {{ $list->jumlah }} [{{ number_format($list->harga) }}] <br>
                                    @endforeach
                                </td>
                                <td>Rp. {{number_format($br->total)}}</td>
                                <td>{{$br->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($history->total() == 0)
                        <div class="text-center">
                            <p>Belum ada transaksi!</p>
                        </div>
                    @endif
                    {{ $history->links() }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
