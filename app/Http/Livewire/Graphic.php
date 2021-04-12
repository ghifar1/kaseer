<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Graphic extends Component
{
    public $filter = 'now';

    public function render()
    {
        $data = '';
        $history = DB::table('histories');
        switch ($this->filter)
        {
            case 'now':
                $data = $history->whereDate('created_at', Carbon::today())->get();
                break;
            case 'month':
                $month = Carbon::now()->format('m');
                $data = $history->whereMonth('created_at', $month)->get();
                break;
        }
        return view('livewire.graphic', [
            'data' => $data
        ]);
    }

    public function changeFilter($filter)
    {
        $this->filter = $filter;
    }
}
