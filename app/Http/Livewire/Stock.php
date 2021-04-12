<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Stock as StockModel;
use Livewire\WithPagination;

class Stock extends Component
{
    use WithPagination;
    public $nama_barang, $harga_satuan, $jumlah, $barcode, $jumlahnew = 0, $invalid = false, $pencarian, $ubahhar = 0, $invalidharga = false;
    public function render()
    {
        return view('livewire.stock', [
            'stock' => StockModel::where('user_id', Auth::id())->where('nama_barang', 'like', '%'.$this->pencarian.'%')->paginate(5),
        ]);
    }

    public function create()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->invalidharga = true;
        $this->invalid = false;
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

    public function tambah($id)
    {
        $this->invalidharga = false;
        $this->invalid = false;
        $stock = StockModel::find($id);
        if(!is_numeric($this->jumlahnew))
        {
            $this->invalid = true;
            return;
        }
        if($stock->jumlah + $this->jumlahnew < 0)
        {
            $this->invalid = true;
            return;
        }
        $stock->jumlah = $stock->jumlah + $this->jumlahnew;
        $stock->save();
    }

    public function ubahharga($id)
    {
        if(!is_numeric($this->ubahhar))
        {
            $this->invalidharga = true;
            return;
        }
        if($this->ubahhar < 0)
        {
            $this->invalidharga = true;
            return;
        }
        $this->invalidharga = false;
        $barang = StockModel::find($id);
        $barang->harga_satuan = $this->ubahhar;
        $barang->save();
        $this->ubahhar = 0;
    }
}
