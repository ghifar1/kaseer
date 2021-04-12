<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $history = History::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        return view('laporan', compact('history'));
    }
}
