<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===================
    // TAMPIL LOGIN
    // ===================
    public function showLogin()
    {
        return view('auth.login');
    }

    // ===================
    // TAMPIL REGISTER
    // ===================
    public function showRegister()
    {
        return view('auth.register');
    }

    // ===================
    // PROSES REGISTER
    // ===================
    public function register(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // SIMPAN KE DATABASE SESUAI TABEL USERS
        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'email_verified_at' => now(),
            'password'          => Hash::make($request->password),
            'role'              => 'customer',
            'no_hp'             => null,
            'foto'              => null,
            'remember_token'    => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    // ===================
    // LOGIN
    // ===================
    public function login(Request $request)
    {
        // VALIDASI
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // CEK LOGIN
        if (Auth::attempt($request->only('email', 'password'))) {

            // REGENERATE SESSION
            $request->session()->regenerate();

            // CEK ROLE
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/customer/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // ===================
    // LOGOUT
    // ===================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}