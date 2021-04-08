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
                <th scope="col" class="rounded-r-xl">Jumlah</th>
            </tr>
            </thead>
            <tbody>
            @foreach($stock as $st)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$st->nama_barang}}</td>
                <td>Rp. {{number_format($st->harga_satuan, 0)}}</td>
                <td>{{$st->jumlah}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
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
