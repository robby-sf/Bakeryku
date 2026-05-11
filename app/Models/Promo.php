<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'type',
        'value',
        'start_date',
        'end_date',
        'description',
        'image',
    ];

    protected $casts = [
        'value' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getStatusAttribute(): string
    {
        $today = now()->startOfDay();

        if ($this->start_date && $today->lt($this->start_date->startOfDay())) {
            return 'Akan Datang';
        }

        if ($this->end_date && $today->gt($this->end_date->startOfDay())) {
            return 'Berakhir';
        }

        return 'Berjalan';
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'discount_percent' => 'Diskon (%)',
            'discount_nominal' => 'Potongan Harga',
            'bundle' => 'Paket Bundel',
            'buy_1_get_1' => 'Buy 1 Get 1',
            'buy_2_get_1' => 'Buy 2 Get 1',
            'free_shipping' => 'Gratis Ongkir',
            default => 'Promo',
        };
    }

    public function getValueLabelAttribute(): string
    {
        if ($this->type === 'discount_percent' && $this->value) {
            return '- ' . $this->value . '%';
        }

        if ($this->type === 'discount_nominal' && $this->value) {
            return '- Rp ' . number_format($this->value, 0, ',', '.');
        }

        return $this->value ? (string) $this->value : '-';
    }
}
