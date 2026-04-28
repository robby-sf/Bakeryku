<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // If already logged in as a user, redirect to dashboard
        if (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user') {
            return redirect()->route('dashboard');
        }
        
        // If logged in as admin, logout gracefully
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('login')->with('info', 'Silakan login sebagai pengguna untuk akses ke fitur user.');
        }
        
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        $credentials['role'] = 'user';

        if (Auth::guard('user')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => '❌ Kredensial login tidak valid. Silakan periksa email dan password Anda kembali.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        // If already logged in as a user, redirect to dashboard
        if (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user') {
            return redirect()->route('dashboard');
        }
        
        // If logged in as admin, logout gracefully
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('register')->with('info', 'Silakan daftar atau login sebagai pengguna.');
        }
        
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => '❌ Email ini sudah terdaftar. Silakan gunakan email lain atau login jika sudah memiliki akun.',
            'email.max' => 'Email maksimal 255 karakter.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', '✅ Akun berhasil dibuat! Silakan login dengan email dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
