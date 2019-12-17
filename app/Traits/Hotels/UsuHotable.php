<?php

namespace App\Traits\Hotels;

use App\Hotel;

trait UsuHotable {
    
    public function favorite(Hotel $hotel) {
        if (! $this->hasFavorited($hotel)) {
            return $this->favorites()->attach($hotel);
        }
    }

    public function hasFavorited(Hotel $hotel) {
        return !! $this->favorites()->where('hotel_id', $hotel->id)->count();
    }

    public function favorites() {
        return $this->belongsToMany(Hotel::class, 'favorites', 'user_id', 'hotel_id')->withTimestamps();
    }
}