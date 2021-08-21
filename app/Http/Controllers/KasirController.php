<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function toPremium()
    {
        $user = User::find(Auth::id());
        $user->is_premium = true;
        $user->save();
        return redirect('/laporan');
    }
}
