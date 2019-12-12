<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Office;
use App\Transformers\OfficesTransformer;
use Illuminate\Http\Request;

class OfficesController extends ApiController
{

    public function __construct(OfficesTransformer $transformer)
    {
        $this->transformer = $transformer;
        // $this->middleware('auth.api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithTransformer(Office::all());
        // return Office::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $office = new Office($request->office);
        $office->slug = $this->generateSlug($office->name);
        // $office->slug = Str::slug($office->name . ' ' . $office->id, '-');
        $office->save();
        return $office;
    }

    public function findSlug($slug)
    {
        $data = Office::query()->where('slug', $slug)->get()->first();
        return $this->respondWithTransformer($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        return $office;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();
    }
}
