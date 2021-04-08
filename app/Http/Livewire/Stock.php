<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Stock as StockModel;

class Stock extends Component
{
    public $stock, $nama_barang, $harga_satuan, $jumlah, $barcode, $open = false;
    public function render()
    {
        $this->stock = StockModel::where('user_id', Auth::id())->get();
        return view('livewire.stock');
    }

    public function create()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->nama_barang = '';
        $this->harga_satuan = '';
        $this->jumlah = '';
        $this->barcode = '';
    }

    public function store()
    {
        $this->validate([
            'nama_barang' => 'required',
            'harga_satuan' => 'required|integer',
            'jumlah' => 'required|integer',
            'barcode' => 'string',
        ]);
        $stock = new StockModel();
        $stock->nama_barang = $this->nama_barang;
        $stock->harga_satuan = $this->harga_satuan;
        $stock->jumlah = $this->jumlah;
        $stock->barcode = $this->barcode;
        $stock->user_id = Auth::id();
        $stock->save();
        session()->flash('message', 'berhasil dimasukkan');
        $this->resetFields();
    }
}
