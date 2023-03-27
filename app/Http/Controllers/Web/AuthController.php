<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $user = User::where('nopol', $request->nopol)->first();
        if ($user->roles == 'ADMIN') {
            $credentials = $request->only('nopol', 'password');
            if (Auth::attempt($credentials)) {
                return redirect("/");
            }
        }
        return back()->with('error', 'Nopol atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
