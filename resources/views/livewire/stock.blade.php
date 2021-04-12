<div>
    <x-modal>
        <x-slot name="button">
            <button class="bg-green-400 px-2 py-1 hover:bg-green-500 rounded-md">Tambah barang</button>
        </x-slot>
        <div>
        </div>
        <x-slot name="modalcontent">
            <form action="#" method="POST">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-3 sm:p-2">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="company_website" class="block text-sm font-medium text-gray-700">
                                    Nama Barang
                                </label>
                                <div class="mt-1 px-2 flex rounded-md shadow-sm">
                                    <input type="text" wire:model="nama_barang" id="company_website" class="w-96 sm:w-full focus:ring-indigo-500 focus:border-indigo-500 flex-1 block rounded-none rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-5 bg-white space-y-3 sm:p-2">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="company_website" class="block text-sm font-medium text-gray-700">
                                    Harga Satuan
                                </label>
                                <div class="mt-1 px-2 flex rounded-md shadow-sm">
                                    <input type="number" wire:model="harga_satuan" id="company_website" class="w-96 sm:w-full focus:ring-indigo-500 focus:border-indigo-500 flex-1 block rounded-none rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-5 bg-white space-y-3 sm:p-2">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="company_website" class="block text-sm font-medium text-gray-700">
                                    Jumlah
                                </label>
                                <div class="mt-1 px-2 flex rounded-md shadow-sm">
                                    <input type="number" wire:model="jumlah" id="company_website" class="w-96 sm:w-full focus:ring-indigo-500 focus:border-indigo-500 flex-1 block rounded-none rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-5 bg-white space-y-3 sm:p-2">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="company_website" class="block text-sm font-medium text-gray-700">
                                    Barcode
                                </label>
                                <div class="mt-1 px-2 flex rounded-md shadow-sm">
                                    <input type="text" wire:model="barcode" id="company_website" class="w-96 sm:w-full focus:ring-indigo-500 focus:border-indigo-500 flex-1 block rounded-none rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button wire:click.prevent="store()" @click="open = !open" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        <button @click="open = !open" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <div class="relative text-gray-600 focus-within:text-gray-400">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </button>
                                        </span>
        <input type="search" wire:model="pencarian" name="q" class="py-2 w-44 mt-1 text-sm text-white  rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
    </div>
    @if(count($stock) > 0)
        @if ($errors->any())
            <div class="relative py-3 m-2 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table my-2">
            <thead class="bg-blue-500 text-white">
            <tr>
                <th scope="col" class="rounded-l-xl">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga satuan</th>
                <th scope="col">Jumlah</th>
                <th class="rounded-r-xl"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($stock as $st)
            <tr>
                <th scope="row" >{{$loop->index + 1}}</th>
                <td>{{$st->nama_barang}}</td>
                <td>
                    <div class="grid grid-cols-2 gap-2 w-60">
                        <div class="flex self-center">
                            <p>Rp. {{number_format($st->harga_satuan, 0)}}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-1 w-40">
                            <input wire:model="ubahhar" class="rounded-md" type="number">
                            <button class="@if(!$invalidharga) bg-blue-400 @else bg-red-500 @endif rounded-md text-white"
                                    wire:click.prevent="ubahharga({{$st->id}})">Ubah</button>
                        </div>
                    </div>
                </td>
                <td>
                <div class="grid grid-cols-2 gap-2 w-12">
                    <div class="flex self-center">
                        <p>{{$st->jumlah}}</p>
                    </div>
                        <div class="grid grid-cols-2 gap-1 w-40">
                            <input wire:model="jumlahnew" class="rounded-md" type="number">
                            <button class="@if(!$invalid) bg-blue-400 @else bg-red-500 @endif rounded-md text-white"
                                    wire:click.prevent="tambah({{$st->id}})">Tambah</button>
                        </div>
                </div>
                </td>
                <td>

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
            @if($stock->total() == 0)
                <div class="text-center">
                    <p>Belum ada transaksi!</p>
                </div>
            @endif
            {{ $stock->links() }}
    @else
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex justify-center items-center w-full h-52">
            <div>
                <p class="text-xl">Sepertinya stok mu kosong nih!</p>
            </div>
        </div>
    @endif
</div>
