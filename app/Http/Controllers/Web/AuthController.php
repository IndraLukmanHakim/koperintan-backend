<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
        $credentials = $request->only('nopol', 'password');
        if (Auth::attempt($credentials)) {
            return redirect("/");
        }
        return back()->with('error', 'The provided credentials do not match our records.');
    }
}
