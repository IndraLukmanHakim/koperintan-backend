<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user', compact('users'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nopol' => 'required|unique:users|regex:/^[A-Z]{2}[0-9]{1,4}[A-Z]{1,3}$/',
            'password' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'nopol.required' => 'Nopol tidak boleh kosong',
            'nopol.unique' => 'Nopol sudah terdaftar',
            'nopol.regex' => 'Nopol tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'phone.required' => 'No. HP tidak boleh kosong',
        ]);

        User::create([
            'name' => $request->name,
            'nopol' => $request->nopol,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
