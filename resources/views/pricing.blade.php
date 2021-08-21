<x-guest-layout>
    <div class="absolute" style="z-index: -9999">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div data-aos="fade-up" data-aos-duration="3000">
                <img src="https://blogpictures.99.co/usaha-kecil-dititip-di-warung.jpg" class="opacity-20 col-span-2">
            </div>
            <div>

            </div>
            <div>

            </div>
            <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="3000">
                <img src="https://technobusiness.id/wp-content/uploads/2020/09/Warung-Pintar-GrabMart-1.-1.jpg"
                     class="opacity-20 float-right w-full sm:w-full">
            </div>
        </div>
    </div>
    <div class="mx-5 mt-6">
        <div class="mx-5 sm:mx-40">
            <p class="mt-10 text-4xl sm:text-6xl text-center font-bold" data-aos="fade-down" data-aos-duration="1000">
                Dirancang untuk UMKM dan Warung
            </p>
        </div>
        <div class="text-center mt-10 text-xl mx-1 sm:mx-32">
            Pencatatan otomatis, laporan bulanan, peringatan stok menipis, dan fitur Kaseer lainnya yang dapat
            meningkatkan penghasilan Anda. Tanpa pusing, tanpa kompromi, Anda dapat melihat perkembangan
            penjualan melalui smartphone.
        </div>
        <div class="text-center mt-20">
            <p class="font-bold text-2xl">Harga Langganan</p>
            <div class="flex flex-wrap justify-around mt-5">
                <a href="https://google.com">
                    <div class="bg-green-400 rounded-md w-72 h-44 m-1">
                        <p class="font-bold mt-2 text-2xl border-b-2">Perbulan</p>
                        <div class="flex h-16 justify-center items-center">
                            <p class="font-bold text-2xl">Rp. 35.000</p>
                        </div>
                        <form action="{{ route('toPremium') }}" method="post">
                            @csrf
                            <button type="submit" class="bg-white rounded-md px-2">Pilih</button>
                        </form>
                        <br>
                        <p class="text-sm font-bold mt-1">(i) Debet pertanggal pembelian</p>
                    </div>
                </a>
                <a href="https://google.com">
                    <div class="bg-green-400 rounded-md w-72 h-44 m-1">
                        <p class="font-bold mt-2 text-2xl border-b-2">Pertahun</p>
                        <div class="flex h-16 justify-center items-center">
                            <p class="font-bold text-2xl">Rp. 378.000</p>
                        </div>
                        <form action="{{ route('toPremium') }}" method="post">
                            @csrf
                            <button type="submit" class="bg-white rounded-md px-2">Pilih</button>
                        </form>
                        <br>
                        <p class="text-sm font-bold mt-1">(i) Potongan <span class="font-bold text-red-500 ">10%</span></p>
                    </div>
                </a>
                <a href="https://google.com">
                    <div class="bg-green-400 rounded-md w-72 h-44 m-1">
                        <p class="font-bold mt-2 text-2xl border-b-2">Lisensi</p>
                        <div class="flex h-16 justify-center items-center">
                            <p class="font-bold text-2xl">Rp. 1.499.999</p>
                        </div>
                        <form action="{{ route('toPremium') }}" method="post">
                            @csrf
                            <button type="submit" class="bg-white rounded-md px-2">Pilih</button>
                        </form>

                        <br>
                    </div>
                </a>
            </div>
        </div>

    </div>
</x-guest-layout>
