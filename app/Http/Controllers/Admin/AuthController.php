<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show admin login form.
     */
    public function showLogin()
    {
        return view('Admin.auth.login');
    }

    /**
     * Handle admin login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $adminCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ];

        if (Auth::guard('admin')->attempt($adminCredentials, $request->boolean('remember'))) {
            $user = Auth::guard('admin')->user();
            $user->update(['last_login_at' => now()]);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil');
        }

        $envAdminEmail = env('ADMIN_EMAIL');
        $envAdminPassword = env('ADMIN_PASSWORD');

        if (
            $envAdminEmail &&
            $envAdminPassword &&
            $credentials['email'] === $envAdminEmail &&
            $credentials['password'] === $envAdminPassword
        ) {
            $user = User::firstOrCreate([
                'email' => $envAdminEmail,
            ], [
                'name' => 'Administrator',
                'password' => Hash::make($envAdminPassword),
                'role' => 'admin',
            ]);

            if ($user->role !== 'admin') {
                $user->update(['role' => 'admin']);
            }

            Auth::guard('admin')->login($user, $request->boolean('remember'));
            $user->update(['last_login_at' => now()]);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil');
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Show admin registration form.
     */
    public function showRegister()
    {
        return view('Admin.auth.register');
    }

    /**
     * Handle admin registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'admin_code' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Simple hardcoded invite code check - customize as needed
        if ($data['admin_code'] !== 'ADMIN_BAKERYKU_2024') {
            return back()->withErrors(['admin_code' => 'Kode akses tidak valid.'])->onlyInput('admin_code', 'name', 'email');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin',
        ]);

        Auth::guard('admin')->login($user);
        return redirect()->route('admin.dashboard')->with('success', 'Akun admin berhasil dibuat.');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }
}
