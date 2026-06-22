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
        if (!Cache::has('app_settings')) {
            Cache::forever('app_settings', [
                'store_name' => 'Slice Bread Bakery',
                'tagline' => 'Cakes, Bread & More...',
                'email' => 'admin@slicebread.com',
                'phone' => '085602385989',
                'address' => 'Surakarta, Indonesia',
                'hours' => '08:00 - 22:00',
                'wa_number' => '+62 856 0238 5989',
            ]);
        }
        
        $settings = Cache::get('app_settings');

        return view('admin.settings.settings', compact('settings'));
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

        // Cache the settings forever
        Cache::forget('app_settings');
        Cache::forever('app_settings', $validated);

        \App\Models\ActivityLog::log('system', 'Pengaturan toko diubah', "Admin mengubah pengaturan toko, termasuk nomor WhatsApp penerima pesanan menjadi {$validated['wa_number']}.");

        return back()->with('success', 'Pengaturan toko berhasil diperbarui!');
    }
}
