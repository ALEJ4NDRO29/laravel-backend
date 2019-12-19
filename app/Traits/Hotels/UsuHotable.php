<?php

namespace App\Traits\Hotels;

use App\Hotel;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

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

    public function redisIncrements($hotel, User $user)
    {
        $redisKey = 'user:' . $user['id'] . ':hotelStats';

        /**
         * 1- Comprobar datos guardados en redis
         *  1.1- No ha visitado nada
         *  1.2- No ha visitado ese hotel
         *  1.3- Ya ha visitado ese hotel
         */

        $array = array (
            $hotel['slug'] => array(
               "view" => 1
            )
        );

        $caca = json_encode($array);
        Log::info($caca);


        Log::debug('redis set ' . $hotel['id']);
        Redis::set($redisKey, $hotel['id']);
    }
}