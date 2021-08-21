<?php

namespace App\Http\Livewire;

use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Stock;
use App\Models\History;
use Livewire\WithPagination;

class Kasir extends Component
{
    use WithPagination;

    public $pencarian, $idbarang, $jumlah = 1, $outofstock = false;
    public function render()
    {
        $user_id = Auth::id();
        if(Auth::user()->toko_id)
        {
            $user_id = Toko::where('id', Auth::user()->toko_id)->first()->user_id;
        }
        return view('livewire.kasir', [
            'barang' => Stock::where('user_id', $user_id)->where('nama_barang', 'like', '%'.$this->pencarian.'%')->paginate(4),
            'cart' => session()->get('cart'),
        ]);
    }

    public function tambah($id)
    {
        $produk = Stock::find($id);
        $cart = session()->get('cart');

        if($produk->jumlah < $this->jumlah || $this->jumlah < 1)
        {
            $this->outofstock = true;
            return;
        }
        $this->outofstock = false;

        if(!$cart)
        {
            $cart= [
                $id => [
                    "nama_produk" => $produk->nama_barang,
                    "jumlah" => $this->jumlah,
                    "harga" => $produk->harga_satuan
                ]
            ];
            session()->put('cart', $cart);
            $produk->jumlah = $produk->jumlah - ($this->jumlah);
            $produk->save();
        } else if(isset($cart[$id]))
        {
            $cart[$id]['jumlah'] = $cart[$id]['jumlah'] + $this->jumlah;
            session()->put('cart', $cart);
            $produk->jumlah = $produk->jumlah - ($this->jumlah);
            $produk->save();
        } else {
            $cart[$id] = [
                "nama_produk" => $produk->nama_barang,
                "jumlah" => $this->jumlah,
                "harga" => $produk->harga_satuan
            ];
            session()->put('cart', $cart);
            $produk->jumlah = $produk->jumlah - ($this->jumlah);
            $produk->save();
        }



    }

    public function hapus($id)
    {
        $this->outofstock = false;
        $cart = session()->get('cart');
        $produk = Stock::find($id);
        $produk->jumlah = $produk->jumlah + $cart[$id]['jumlah'];
        unset($cart[$id]);
        session()->put('cart', $cart);
        $produk->save();
    }

    public function checkout()
    {
        $history = new History;
        $cart = session()->get('cart');
        $total = 0;
        $history->keranjang = json_encode($cart);
        foreach ($cart as $c)
        {
            $total = $total + ($c['jumlah']*$c['harga']);
        }
        $history->total = $total;
        if(Auth::user()->toko_id)
        {
            $history->user_id = Toko::where('id', Auth::user()->toko_id)->first()->user_id;
        } else {
            $history->user_id = Auth::id();
        }
        $history->save();
        session()->forget('cart');
    }
}
