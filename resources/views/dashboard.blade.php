<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kasir
            @if($user->toko_id)
                <span class="text-green-600">(Toko {{ \App\Models\Toko::where('id', $user->toko_id)->first()->name }})</span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
                    <livewire:kasir />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
