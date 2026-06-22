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
        // If already logged in as a user, keep them on the public home page.
        if (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user') {
            return redirect()->route('landing_page');
        }

        return view('auth.login');
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
            $user = Auth::guard('user')->user();
            $request->session()->regenerate();
            \App\Models\ActivityLog::log('user_login', 'Pengguna masuk', "Pengguna {$user->name} masuk ke akun.", $user->id);
            return redirect()->route('landing_page')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'email' => '❌ Kredensial login tidak valid. Silakan periksa email dan password Anda kembali.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        // If already logged in as a user, keep them on the public home page.
        if (Auth::guard('user')->check() && Auth::guard('user')->user()->role === 'user') {
            return redirect()->route('landing_page');
        }

        return view('auth.register');
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

        \App\Models\ActivityLog::log('user_register', 'Pengguna baru mendaftar', "Pengguna {$user->name} berhasil membuat akun baru.", $user->id);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login dengan email dan password Anda.');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
