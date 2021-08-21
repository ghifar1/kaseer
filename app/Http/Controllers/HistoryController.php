<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportExport;
use Excel;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_premium']);
    }

    public function index()
    {
        $user_id = Auth::id();
        if(Auth::user()->toko_id)
        {
            $user_id = Toko::where('id', Auth::user()->toko_id)->first()->user_id;
        }
        $history = History::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('laporan', compact('history'));
    }

    public function testPrint()
    {
        $user_id = Auth::id();
        if(Auth::user()->toko_id)
        {
            $user_id = Toko::where('id', Auth::user()->toko_id)->first()->user_id;
        }
        $history = History::where('user_id', $user_id)->get();
        return view('report', compact('history'));
    }

    public function export()
    {
        return Excel::download(new ReportExport, 'test.xlsx');
    }
}
