@php
$total = 0;
@endphp
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="">
        <p class="font-bold text-2xl">Pencarian Barang</p>
        <!-- component -->
        <div>
            <form method="GET">
                <div class="relative text-gray-600 focus-within:text-gray-400">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </button>
                                        </span>
                    <input type="search" wire:model="pencarian" name="q" class="py-2 w-1/2 text-sm text-white  rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
                </div>
            </form>
        </div>
        <table class="table my-2">
            <thead class="bg-blue-500 text-white">
            <tr>
                <th scope="col" class="rounded-l-xl">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Jumlah</th>
                <th scope="col" class="rounded-r-xl">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($barang as $br)
                <tr>
                    <th scope="row">{{$loop->index + 1}}</th>
                    <td>{{$br->nama_barang}}</td>
                    <td>{{ number_format($br->harga_satuan) }}</td>
                    <td>{{$br->jumlah}}</td>
                    <td>
                        @if($br->jumlah == 0)
                            <div class="text-center">
                                <p class="text-red-500 font-bold">Barang habis</p>
                            </div>
                        @else
                            <div class="w-36">
                                <div class="grid grid-cols-2 gap-1">
                                    <input wire:model="jumlah" class="rounded-md" type="number">
                                    <button class="@if(!$outofstock) bg-blue-400 @else bg-red-500 @endif rounded-md text-white"
                                            wire:click.prevent="tambah({{$br->id}})">Tambah</button>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($barang->total() == 0)
            <div class="text-center">
                <p>Stok barangmu kosong!</p>
            </div>
        @endif
        {{ $barang->links() }}
    </div>

    <div class="p-2 bg-white border-2 border-green-600 rounded-md">
        <p class="font-bold text-xl">Keranjang</p>
        <div class="relative h-96 overflow-y-auto">
            <div class="absolute w-full">
                @if($cart)
                    @if(count($cart) > 0)
                        @foreach($cart as $index => $cid)
                            <div class="p-2 my-2 border border-gray-300 rounded-md bg-gray-100">
                                <div class="text-right">
                                    <i wire:click="hapus({{ $index }})" class="fas fa-times"></i>
                                </div>
                                <div class="grid grid-cols-4 grid-rows-2">
                                    <div class="col-span-3 row-span-1">
                                        <p class="font-bold text-2xl">{{ $cid['nama_produk'] }}</p>
                                    </div>
                                    <div class="flex col-span-1 row-span-2 justify-center self-center">
                                        <p class="font-bold text-xl">Rp. {{ number_format($cid['jumlah'] * $cid['harga']) }}</p>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-bold">{{ $cid['jumlah'] }} buah x Rp. {{ number_format($cid['harga']) }}</p>
                                    </div>
                                    @php
                                        $total = $total + ($cid['jumlah'] * $cid['harga'])
                                    @endphp
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>Belum ada barang di keranjang</p>
                        </div>
                    @endif
                @else
                    <div class="text-center">
                        <p>Belum ada barang di keranjang</p>
                    </div>
                @endif
            </div>
        </div>


        <!-- total keranjang -->
        <div class="grid grid-cols-2">
            <div class="flex justify-center justify-self-start">
                @if($cart)
                    <button wire:click="checkout" class="bg-green-400 px-3 m-1 rounded-md">simpan</button>
                @endif
            </div>
            <div class="py-3 text-right px-2">
                <p class="font-bold text-red-600 text-xl">Total : {{ number_format($total) }}</p>
            </div>
        </div>
    </div>
</div>
