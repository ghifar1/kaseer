<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan Akun
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-5 bg-white border-b border-gray-200">
                    <div>
                        <p class="font-bold">Ringkasan Akun</p>
                        <hr class="my-2">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <div class="grid grid-cols-2 md:grid-cols-4">
                                <div class="grid grid-cols-1 col-span-1">
                                    <div>ID Akun</div>
                                    <div>Nama</div>
                                    <div>Email</div>
                                </div>
                                <div class="grid grid-cols-1">
                                    <div>{{ $user->uuid }}</div>
                                    <div>{{ $user->name }}</div>
                                    <div>{{ $user->email }}</div>
                                </div>
                            </div>
                            <a href="{{ url('editAkun/') }}" class="text-blue-500">Edit akun</a>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-5 bg-white border-b border-gray-200">
                <div>
                    <p class="font-bold">Pengaturan Toko</p>
                    <hr class="my-2">
                </div>
                @if(!$toko)
                    <div class="flex justify-center h-24 items-center">
                        <div>
                            Kamu belum punya toko <br>
                            <button id="buat-toko" class="transition duration-300 bg-blue-300 px-2 rounded-md hover:bg-blue-500 hover:text-white focus:outline-none">Buat toko</button>
                            <button id="ikut-toko" class="transition duration-300 bg-green-300 px-2 rounded-md hover:bg-green-500 hover:text-white focus:outline-none">Ikut toko</button>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="grid grid-cols-2 md:grid-cols-4">
                            <div class="grid grid-cols-1 col-span-1">
                                <div>Nama Toko</div>
                                <div>Status Kepemilikan</div>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>{{ \App\Models\Toko::where('id', $user->toko_id)->first()->name }}</div>
                                <div>
                                    @php
                                        $toks = \App\Models\Toko::where('id', $user->toko_id)->first()
                                    @endphp
                                    @if($toks->user_id == $user->id)
                                        Pemilik
                                    @else
                                        Mengikuti
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $toks = \App\Models\Toko::where('id', $user->toko_id)->first();
                    @endphp
                    @if($toks->user_id != $user->id)
                        <button id="stop-toko" class="text-blue-500 focus:outline-none">Stop ikuti toko</button>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="grid grid-cols-2 md:grid-cols-4">
                                <div class="grid grid-cols-1 col-span-1">
                                    <div>Anggota Toko</div>
                                </div>
                                <div class="grid grid-cols-1">
                                    @php
                                        $anggotas = \App\Models\User::where('toko_id', $user->toko_id)->get();
                                    @endphp
                                    @foreach($anggotas as $anggota)
                                        <div>- {{ $anggota->name }}</div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </div>
    </div>
    <script>
        $(function ()
        {

            $('#stop-toko').on('click', ()=>{
                Swal.fire({
                    title: 'Berhenti mengikuti toko',
                    text: 'Apakah kamu yakin ingin berhenti mengikuti toko?',
                    confirmButtonText: 'Berhenti',
                    icon: 'warning',
                    showCancelButton: true,
                    allowOutsideClick: false,
                }).then((result)=>{
                    if(result.isConfirmed)
                    {
                        $.ajax({
                            url: '{{ url('stopToko') }}',
                            method: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: (res)=>{
                                Swal.fire({
                                    title: 'Berhasil berhenti mengikuti toko!',
                                    icon: 'success',
                                }).then(()=>{
                                    location.reload()
                                })
                            },
                            error: (err)=>{

                            }
                        })
                    }
                })
            })

            $('#buat-toko').on('click', async ()=>{
                var idtoko = '{{ \Illuminate\Support\Facades\Auth::user()->uuid }}'
                var nametoko = await Swal.fire({
                    title: 'Buat Toko',
                    input: 'text',
                    inputLabel: 'Masukkan nama toko',
                    confirmButtonText: 'Simpan',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'nama toko tidak boleh kosong!'
                        }
                    }
                })
                var alamattoko = ''
                if(nametoko.isConfirmed)
                {
                     alamattoko = await Swal.fire({
                        title: 'Alamat Toko Toko',
                        input: 'text',
                        inputLabel: 'Masukkan alamat toko',
                        confirmButtonText: 'Simpan',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'alamat toko tidak boleh kosong!'
                            }
                        }
                    })
                }

                if(nametoko.isConfirmed && alamattoko.isConfirmed)
                {
                    $.ajax({
                        url: '{{ url('createToko') }}',
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "user_id": "{{ $user->id }}",
                            "nameToko": nametoko.value,
                            "alamatToko": alamattoko.value,
                        },
                        success: (res)=>{
                            Swal.fire({
                                title: 'Toko berhasil dibuat!',
                                icon: 'success',
                            }).then(()=>{
                                location.reload()
                            })
                        },
                        error: (err)=>{
                            console.log(err)
                        }
                    })
                }
            })

            $('#ikut-toko').on('click',async ()=>{
                var idtoko

                await inputToko()
                async function inputToko()
                {
                    idtoko = await Swal.fire({
                        title: 'Ikuti toko',
                        input: 'text',
                        inputLabel: 'Masukkan id pemilik toko',
                        confirmButtonText: 'Cari',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'id toko tidak boleh kosong!'
                            }
                        }
                    })
                    if(idtoko.isConfirmed)
                    {
                        $.ajax({
                            url: `{{ url('getToko') }}/${idtoko.value}`,
                            method: 'get',
                            success: (res) =>{
                                if(!res)
                                {
                                    Swal.fire({
                                        title: 'Toko tidak ditemukan',
                                        icon: 'error'
                                    })

                                    return;
                                }

                                Swal.fire({
                                    title: `Informasi Toko`,
                                    html: `Nama Toko: <b>${res.toko_name}</b> <br>
                                    Pemilik: <b>${res.user_name}</b> <br>

                                    Apakah Anda ingin mengikuti toko ini?`,
                                    showCancelButton: true,
                                }).then((result) =>{
                                    if(result.isConfirmed)
                                    {
                                        $.ajax({
                                            url: '{{ url('followToko') }}',
                                            method: 'POST',
                                            data: {
                                                "_token": '{{ csrf_token() }}',
                                                "id_toko": res.id_toko,
                                            },
                                            success: (res)=>{
                                                Swal.fire({
                                                    title: 'Berhasil mengikuti toko!',
                                                    icon: 'success',
                                                }).then(()=>{
                                                    location.reload()
                                                })
                                            },
                                            error: (err)=>{
                                                console.log(err)
                                            }
                                        })
                                    }
                                })
                            },
                            error: (err)=>{

                            }
                        })
                    }


                }




            })
        })

    </script>

</x-app-layout>
