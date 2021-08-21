<x-guest-layout>

    <div class="w-screen">
        <div id="bg-front" class="absolute w-full h-1/2" style="z-index: -999">

        </div>
        <div class="mx-5 sm:mx-32 pt-14">
            <div class="font-bold text-6xl sm:text-8xl ">
                KASEER
            </div>
            <div class="mx-1 sm:text-xl">
                Kasir online untuk kebutuhan warung Anda
            </div>
            <div class="flex flex-wrap justify-center mt-6 sm:mt-16">
                <div data-aos="fade-down" data-aos-delay="200" data-aos-duration="1000" class="bg-green-200 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-calculator fa-3x"></i>
                    <p>Penghitung Otomatis</p>
                </div>
                <div data-aos="fade-down" data-aos-delay="400" data-aos-duration="1000" class="bg-green-100 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-file-invoice fa-3x"></i>
                    <p>Laporan Bulanan</p>
                </div>
                <div data-aos="fade-down" data-aos-delay="600" data-aos-duration="1000" class="bg-green-200 w-56 rounded-md p-3 m-3 text-center font-bold">
                    <i class="fas fa-box-open fa-3x"></i>
                    <p>Tambah / Kurangi Stok</p>
                </div>
            </div>
        </div>
    </div>

    <div class="relative sm:absolute bottom-2 font-bold text-center w-full">
        <p>Copyright 2021 Ghifari</p>
    </div>

    <!-- fantajs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>
    <script>
        VANTA.GLOBE({
            el: "#bg-front",
            mouseControls: true,
            touchControls: true,
            gyroControls: false,
            minHeight: 200.00,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x3fff55,
            color2: 0x1670f2,
            size: 0.80,
            backgroundColor: 0xffffff
        })
    </script>


</x-guest-layout>
