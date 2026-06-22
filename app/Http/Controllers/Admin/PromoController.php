<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = Promo::query()->latest();
        $today = now()->toDateString();

        if ($status === 'running') {
            $query->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today);
        } elseif ($status === 'upcoming') {
            $query->whereDate('start_date', '>', $today);
        } elseif ($status === 'expired') {
            $query->whereDate('end_date', '<', $today);
        }

        $promos = $query->paginate(10)->withQueryString();

        return view('admin.promo.promos', compact('promos', 'status'));
    }

    public function create()
    {
        return view('admin.promo.add_promos');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePromo($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('promos', 'public');
        }

        Promo::create($validated);

        return redirect()->route('admin.promos')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.add_promos', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $this->validatePromo($request, false);

        if ($request->hasFile('image')) {
            if ($promo->image) {
                Storage::disk('public')->delete($promo->image);
            }
            $validated['image'] = $request->file('image')->store('promos', 'public');
        }

        $promo->update($validated);

        return redirect()->route('admin.promos')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        if ($promo->image) {
            Storage::disk('public')->delete($promo->image);
        }

        $promo->delete();

        return redirect()->route('admin.promos')->with('success', 'Promo berhasil dihapus!');
    }

    private function validatePromo(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:discount_percent,discount_nominal,bundle,buy_1_get_1,buy_2_get_1,free_shipping'],
            'value' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);
    }
}
