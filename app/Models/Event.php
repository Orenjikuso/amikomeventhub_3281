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
     * Prioritas: 1) File di storage, 2) Asset asli seeder, 3) Default concert.png
     */
    public function getPosterUrlAttribute(): string
    {
        // Cek apakah poster ada di storage (file yang di-upload)
        if ($this->poster_path && Storage::disk('public')->exists($this->poster_path)) {
            return asset('storage/' . $this->poster_path);
        }

        // Fallback: map poster seeder ke asset asli di public/assets/
        $assetMap = [
            'posters/event-1.png' => 'assets/concert.png',
            'posters/event-2.png' => 'assets/hackathon.png',
            'posters/event-3.png' => 'assets/workshop.png',
        ];

        if ($this->poster_path && isset($assetMap[$this->poster_path])) {
            return asset($assetMap[$this->poster_path]);
        }

        // Fallback ke gambar default
        return asset('assets/concert.png');
    }
}
