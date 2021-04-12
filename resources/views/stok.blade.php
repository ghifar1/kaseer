<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Stok Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
                    @if(session()->has('message'))
                        berhasil
                    @endif
                    <livewire:stock/>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
