<?php

namespace App\Http\Controllers\API;

use App\Hotel;
use App\Http\Controllers\ApiController;
use App\Transformers\HotelsTransformer;
use Illuminate\Http\Request;

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
        return Hotel::all();
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
        $caca = "";
        $hotels = Hotel::query()->where('slug', $slug)->get()->first();
        // foreach ($hotels->hotels as $user){
        //     $caca.=$user;
        // }
        // return $hotels;
        // return $hotels->users;
        // $hotels = Hotel::all()->pluck('name');
        return $this->respondWithTransformer($hotels);
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
