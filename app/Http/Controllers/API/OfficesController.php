<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfficesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Office::all();
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
        return Office::query()->where('slug', $slug)->get();
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
