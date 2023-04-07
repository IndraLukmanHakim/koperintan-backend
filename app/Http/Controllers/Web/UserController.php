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

    public function get(User $user)
    {
        $html = "
        <input type='hidden' name='id' value='$user->id'>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <input type='text' class='form-control' id='name' name='name_update' placeholder='Nama' value='$user->name'>
                <label for='name'>Nama</label>
            </div>
        </div>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <input type='text' class='form-control' id='phone' name='phone_update' placeholder='Phone' value='$user->phone'>
                <label for='phone'>Phone</label>
            </div>
        </div>
        <div class='validation-container mb-4'>
            <div class='form-floating'>
                <input type='text' class='form-control' id='point' name='point_update' placeholder='Point' value='$user->point'>
                <label for='point'>Point</label>
            </div>
        </div>
        ";
        return response()->json($html);
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

    public function update(Request $request)
    {
        $request->validate([
            'name_update' => 'required',
            'phone_update' => 'required',
            'point_update' => 'required',
        ], [
            'name_update.required' => 'Nama tidak boleh kosong',
            'nopol_update.required' => 'Nopol tidak boleh kosong',
            'point_update.required' => 'Point tidak boleh kosong',
        ]);

        $user = User::find($request->id);
        $user->update([
            'name' => $request->name_update,
            'phone' => $request->phone_update,
            'point' => $request->point_update,
        ]);

        return redirect()->back()->with('success', 'User berhasil diubah');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
