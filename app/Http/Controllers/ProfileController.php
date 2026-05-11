<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the user profile.
     */
    public function show()
    {
        $user = Auth::guard('user')->user();
        return view('profile', compact('user'));
    }

    /**
     * Update user profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::guard('user')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar di sistem.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'date_of_birth.date' => 'Format tanggal tidak valid.',
            'address.max' => 'Alamat maksimal 500 karakter.',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('user')->user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Kata sandi saat ini tidak sesuai.');
                    }
                },
            ],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ], [
            'current_password.required' => 'Kata sandi saat ini harus diisi.',
            'password.required' => 'Kata sandi baru harus diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
