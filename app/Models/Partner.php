<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'logo_url',
        'logo_path',
    ];

    /**
     * Mendapatkan URL logo yang valid.
     * Prioritas: 1) File upload di storage, 2) URL eksternal, 3) null
     */
    public function getLogoDisplayUrlAttribute(): ?string
    {
        if ($this->logo_path && Storage::disk('public')->exists($this->logo_path)) {
            return asset('storage/' . $this->logo_path);
        }

        if ($this->logo_url) {
            return $this->logo_url;
        }

        return null;
    }
}
