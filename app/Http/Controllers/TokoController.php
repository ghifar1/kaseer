<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TokoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if($user->toko_id)
        {
            $toko = $user->toko_id;
        } else {
            $toko = "";
        }
        return view('setting', compact('user', 'toko'));
    }

    public function getToko($uuid)
    {
        if($uuid == Auth::user()->uuid)
        {
            return response()->json( "", 200);
        }
        $user = User::where('uuid', $uuid)->first();
        if($user)
        {
            $toko = $user->toko;
            if($toko)
            {
                return response()->json([
                    'id_toko' => $toko->id,
                    'id_user' => $user->id,
                    'user_name' => $user->name,
                    'toko_name' => $toko->name,
                ], 200);
            }
            return response()->json( "", 200);
        } else {
            $toko = "";
            return response()->json( "", 200);
        }

    }

    public function followToko(Request $request)
    {
        $user = User::find(Auth::id());
        $user->toko_id = $request->id_toko;
        $user->save();

        return response()->json("", 200);
    }

    public function createToko(Request $request)
    {
        $toko = Toko::create([
            'name' => $request->nameToko,
            'address' => $request->alamatToko,
            'user_id' => $request->user_id,
        ]);

        $user = User::find(Auth::id());
        $user->toko_id = $toko->id;
        $user->save();

        return response()->json('sukses', 200);
    }

    public function editAkun()
    {
        $user = Auth::user();

        return view('editakun', compact('user'));
    }

    public function changeData(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->hp = $request->hp;
        $user->save();
        return redirect()->back()->with(["success" => "data berhasil diubah"]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        if(Hash::check($request->oldpassword, $user->password)){
            $user->password = Hash::make($request->newpassword);
            $user->save();
            return redirect()->back()->with(["success" => "password berhasil diubah"]);
        } else {
            return redirect()->back()->with(["failed" => "password lama salah"]);
        }
    }

    public function stopToko()
    {
        $user = Auth::user();
        $user->toko_id = null;
        $user->save();

        return response()->json('sukses', 200);
    }
}
