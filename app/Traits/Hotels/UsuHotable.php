<?php

namespace App\Traits\Hotels;

use App\Hotel;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

trait UsuHotable
{

    public function favorite(Hotel $hotel)
    {
        if (!$this->hasFavorited($hotel)) {
            return $this->favorites()->attach($hotel);
        }
    }

    public function hasFavorited(Hotel $hotel)
    {
        return !!$this->favorites()->where('hotel_id', $hotel->id)->count();
    }

    public function favorites()
    {
        return $this->belongsToMany(Hotel::class, 'favorites', 'user_id', 'hotel_id')->withTimestamps();
    }

    public function redisIncrements($hotel, User $user)
    {
        $slug = $hotel['slug'];
        $array = array();
        $redisKey = 'user:' . $user['id'] . ':hotelStats';
        Log::debug($redisKey);

        $redisResp = Redis::get($redisKey);
        $redisRespArray = json_decode($redisResp, true);
        

        if ($redisResp == null || !array_key_exists($slug, $redisRespArray)) {
            Log::debug('Añadir nuevo');
            $array = array(
                "view" => 1
            );

            // AÑADIR NUEVO
            $redisRespArray[$slug] = $array;
        } else {
            Log::debug('Ampliar');
            $redisRespArray[$slug]['view']++;
        }

        $json = json_encode($redisRespArray);

        Log::debug('Redis set:');
        Log::debug($json);
        
        Redis::set($redisKey, $json);
    }
}
