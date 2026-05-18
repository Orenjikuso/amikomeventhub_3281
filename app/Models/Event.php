<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = [
        'category_id', 'title', 'description', 'date',
        'location', 'price', 'stock', 'poster_path'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Menandakan atribut: 1 Event harus terpaut pada satu wujud Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mendapatkan URL poster event yang valid.
     * Prioritas: 1) File di storage, 2) Gambar default concert.png
     */
    public function getPosterUrlAttribute(): string
    {
        // Cek apakah poster ada di storage (file yang di-upload)
        if ($this->poster_path && Storage::disk('public')->exists($this->poster_path)) {
            return asset('storage/' . $this->poster_path);
        }

        // Fallback ke gambar default
        return asset('assets/concert.png');
    }
}
