<?php

namespace App\Http\Controllers\API;

use App\Hotel;
use App\Http\Controllers\ApiController;
use App\Transformers\HotelsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class HotelController extends ApiController {

    public function __construct(HotelsTransformer $transformer) {
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // TODO: Redis get...
        /**
         * Ordenar array que devuelve redis
         * 
         * Copiar de base de datos los que se encuentren en redis
         * a un array temporal para tener el resto de datos
         * 
         * Los que existan en redis aparecen arriba
         */

        $user = auth()->user();
        
        if($user != null) {
            Log::debug("Logged user");

            $hotelsDB = Hotel::all();
            $hotels = $this->userShort($user, $hotelsDB);
        } else {
            $hotels = Hotel::all();
        }
        
        return $this->respondWithTransformer($hotels);
    }

    /**
     * @param user
     * @param hotels list
     * @return \Illuminate\Database\Eloquent\Collection Listado ordenado para el usuario
     */
    private function userShort($user, $hotelsDB) {
        Log::debug('Start sort for user ' . $user['username']);

        $inRedis = Hotel::getInRedis($user);

        return $hotelsDB;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $hotel = new Hotel($request-> hotels);
        $hotel->slug = $this->generateSlug($hotel->name);
        $hotel-> save();
        return $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel) {
        return $hotel;
    }

    public function findSlug($slug) { 
        $hotel = Hotel::query()->where('slug', $slug)->get()->first();
        $transformer = $this->transformer->item($hotel);

        $userId = auth()->user();
        
        if($userId != null && $hotel) {
            $hotel->redisIncrements($transformer['hotels'], $userId);
        }

        return $this->respondWithTransformer($hotel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel) {
        $hotel -> delete();
    }
}
