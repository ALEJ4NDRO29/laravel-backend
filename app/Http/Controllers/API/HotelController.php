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
        $hotels = Hotel::all();
        return $this->respondWithTransformer($hotels);
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
            $hotel->redisIncrements($transformer, $userId);
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
