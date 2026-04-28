<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Show the settings form.
     */
    public function show()
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return [
                'store_name' => 'Slice Bread Bakery',
                'tagline' => 'Cakes, Bread & More...',
                'email' => 'admin@slicebread.com',
                'phone' => '081234567890',
                'address' => 'Surakarta, Indonesia',
                'hours' => '08:00 - 22:00',
                'wa_number' => '+62 812 1314 1500',
            ];
        });

        return view('Admin.Settings.settings', compact('settings'));
    }

    /**
     * Update application settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'hours' => 'required|string|max:100',
            'wa_number' => 'required|string|max:20',
        ], [
            'store_name.required' => 'Nama toko harus diisi.',
            'tagline.required' => 'Tagline harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'hours.required' => 'Jam operasional harus diisi.',
            'wa_number.required' => 'Nomor WhatsApp harus diisi.',
        ]);

        // Cache the settings
        Cache::put('app_settings', $validated, null);

        return back()->with('success', 'Pengaturan toko berhasil diperbarui!');
    }
}
