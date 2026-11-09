<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', trim($request->username))->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Username atau password salah!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->with('error', 'Username atau password salah!');
        }

        session([
            'logged_in' => true,
            'user_id'   => $user->id_user,
            'user_nama' => $user->nama,
            'username'  => $user->username,
            'role'      => $user->level,
        ]);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('auth.index');
    }
}