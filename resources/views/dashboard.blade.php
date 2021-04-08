<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kasir
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
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
                                        <input type="search" name="q" class="py-2 w-1/2 text-sm text-white  rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
                                    </div>
                                </form>
                            </div>
                            <table class="table my-2">
                                <thead class="bg-blue-500 text-white">
                                <tr>
                                    <th scope="col" class="rounded-l-xl">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col" class="rounded-r-xl">Handle</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td class="bg-red-500 text-white">Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-2 bg-white border-2 border-green-600 rounded-md">
                            <p class="font-bold text-xl">Keranjang</p>
                            <div class="p-2 my-2 border border-gray-300 rounded-md bg-gray-100">
                                <div class="grid grid-cols-4 grid-rows-2">
                                    <div class="col-span-3 row-span-1">
                                        <p class="font-bold text-2xl">Coca Cola 250ml</p>
                                    </div>
                                    <div class="flex col-span-1 row-span-2 justify-center self-center">
                                        <p class="font-bold text-xl">Rp. 76.0000</p>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-bold">5 buah x Rp. 5000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 my-2 border border-gray-300 rounded-md bg-gray-100">
                                <div class="grid grid-cols-4 grid-rows-2">
                                    <div class="col-span-3 row-span-1">
                                        <p class="font-bold text-2xl">Coca Cola 250ml</p>
                                    </div>
                                    <div class="flex col-span-1 row-span-2 justify-center self-center">
                                        <p class="font-bold text-xl">Rp. 76.0000</p>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-bold">5 buah x Rp. 5000</p>
                                    </div>
                                </div>
                            </div>


                            <!-- total keranjang -->
                            <div class="py-3 text-right px-2">
                                <p class="font-bold text-red-600">Total : Rp. 120.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
