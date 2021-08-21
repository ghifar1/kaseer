<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Akun
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ url('changeData') }}" method="POST">
                    @csrf
                    <div class="p-5 bg-white border-b border-gray-200 mx-10">
                        <div class="grid grid-cols-2">
                            <div class="grid grid-cols-1">
                                <div>Nama</div>
                                <div>No Hp</div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <input name="name" type="text" value="{{ $user->name }}" class="rounded-md" required>
                                <input name="hp" type="number" value="{{ $user->hp }}" class="rounded-md" required>
                            </div>
                        </div>
                        <button type="submit" class="bg-green-500 px-2 rounded-md text-white">Simpan</button>
                    </div>
                </form>

                <form action="{{ url('changePassword') }}" method="POST">
                    @csrf
                    <div class="p-5 bg-white border-b border-gray-200 mx-10">
                        <div class="grid grid-cols-2">
                            <div class="grid grid-cols-1">
                                <div>Password lama</div>
                                <div>Password baru</div>
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <input type="text" name="oldpassword" class="rounded-md" required>
                                <input type="text" name="newpassword" class="rounded-md" required>
                            </div>
                        </div>
                        <button type="submit" class="bg-green-500 px-2 rounded-md text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(\Illuminate\Support\Facades\Session::get('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::get('failed'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ \Illuminate\Support\Facades\Session::get('failed') }}',
                icon: 'error',
            })
        </script>
    @endif

    <script>
        $(function ()
        {

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
