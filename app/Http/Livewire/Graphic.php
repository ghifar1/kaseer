<?php

namespace App\Http\Livewire;

use App\Models\Toko;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Charts\Grafik;
use Livewire\Component;

class Graphic extends Component
{
    public $filter = 'now', $total = 0;
    public $high_income, $tot_prod_sold, $high_prod_id_sold, $qty_high_prod_sold, $high_prod_name;
    public $qty_foreach_prod_sold ,$qty_high_bundle_prod_sold;
    public $barang = array();

    public function render()
    {
        $data = '';
        $history = DB::table('histories');
        $labels = [];
        $datasets = [];
        $this->resetVariable();
        $user_id = Auth::id();
        if(Auth::user()->toko_id)
        {
            $user_id = Toko::where('id', Auth::user()->toko_id)->first()->user_id;
        }
        switch ($this->filter)
        {
            case 'now':
                $data = $history->where('user_id', $user_id)->whereDate('created_at', Carbon::today())->get();
                foreach ($data as $idx => $dt)
                {
                    $this->total += $dt->total;
                    if($dt->total > $this->high_income)
                    {
                        $this->high_income = $dt->total;
                    }
                    $labels[$idx] = Carbon::parse($dt->created_at)->format('H:i');
                    $datasets[$idx] = $dt->total;
                    //kalkulasi barang
                    $this->stockCalculation(json_decode($dt->keranjang));
                    $this->highestSellingProduct(json_decode($dt->keranjang));
                    if($this->qty_foreach_prod_sold > $this->qty_high_bundle_prod_sold)
                    {
                        $this->qty_high_bundle_prod_sold = $this->qty_foreach_prod_sold;
                    }
                    $this->soldStock($dt->keranjang);
                }
                break;

            case 'month':
                $month = Carbon::now()->format('m');
                $data = $history->where('user_id', $user_id)->whereMonth('created_at', $month)->get();
                foreach ($data as $idx => $dt)
                {
                    $this->total += $dt->total;
                    if($dt->total > $this->high_income)
                    {
                        $this->high_income = $dt->total;
                    }
                    $labels[$idx] = Carbon::parse($dt->created_at)->format('D:d');
                    $datasets[$idx] = $dt->total;
                    //kalkulasi barang
                    $this->stockCalculation(json_decode($dt->keranjang));
                    $this->highestSellingProduct(json_decode($dt->keranjang));
                    if($this->qty_foreach_prod_sold > $this->qty_high_bundle_prod_sold)
                    {
                        $this->qty_high_bundle_prod_sold = $this->qty_foreach_prod_sold;
                    }
                    $this->soldStock($dt->keranjang);
                }
                break;
        }

        usort($this->barang, function ($a, $b){
            return $b['jumlah'] <=> $a['jumlah'];
        });


        $chart = new Grafik;
        $chart->labels($labels);
        $chart->dataset('Test', 'line', $datasets);
        $this->emit('labelsUpdated', json_encode($labels));
        $this->emit('datasetsUpdated', json_encode($datasets));
        return view('livewire.graphic', [
            'data' => $data,
            'chart' => $chart,
            'total' => $this->total
        ]);
    }

    function soldStock($stock_arr)
    {
        $stock_arr = json_decode($stock_arr);
        foreach ($stock_arr as $key => $item)
        {
            $found = false;
            foreach ($this->barang as $key2 => $item2)
            {
                if($item2['nama_produk'] === $item->nama_produk)
                {
                    $found = true;
                }
            }

            if($found)
            {
                foreach ($this->barang as $key2 => $item2)
                {
                    if($item2['nama_produk'] === $item->nama_produk)
                    {
                        $new =  $item2['jumlah'] + $item->jumlah;
                        $this->barang[$key2]['jumlah'] = $new;
                    }
                }

            } else {
                array_push($this->barang, array('nama_produk' => $item->nama_produk, 'jumlah' => $item->jumlah));
            }

        }
    }

    function resetVariable()
    {
        $this->total = 0;
        $this->high_income = 0;
        $this->tot_prod_sold = 0;
        $this->qty_high_prod_sold = 0;
        $this->high_prod_id_sold = 0;
        $this->qty_foreach_prod_sold = 0;
        $this->qty_high_bundle_prod_sold = 0;
        $this->barang = array();
    }

    function stockCalculation($stock_list)
    {

        foreach($stock_list as $product)
        {
            $this->tot_prod_sold += $product->jumlah;
        }
    }

    function highestSellingProduct($stock_list)
    {
        $this->qty_foreach_prod_sold = 0;
        foreach($stock_list as $index=>$product)
        {
            if($product->jumlah > $this->qty_high_prod_sold)
            {
                $this->qty_high_prod_sold = $product->jumlah;
                $this->high_prod_id_sold = $index;
            }

            $this->qty_foreach_prod_sold += $product->jumlah;
        }
        $this->high_prod_name = DB::table('stocks')->where('id', $this->high_prod_id_sold)->first()->nama_barang;
    }


    public function changeFilter($filter)
    {
        $this->filter = $filter;
    }
}
