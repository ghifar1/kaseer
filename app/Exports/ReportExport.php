<?php

namespace App\Exports;
use App\Models\History;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('report', [
            'history' => History::where('user_id', Auth::id())->get()
        ]);
    }
}
