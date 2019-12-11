<?php

namespace App;

use App\Traits\Hotels\UsuHotable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model {

    use UsuHotable;

    protected $table = "hoteles";

    protected $fillable = [
        'name', 'stars', 'country', 'company'
    ];

    public function usuarios() {
        return $this->belongsToMany('App\User');
    }

    // public static function getHotel() {
        
    //     // $id = Auth::user()->id;
    //     $res = DB::table('hoteles')
    //         ->select('*')
    //         // ->where('id', '=', $id)
    //         ->get();
        
    //     return $res;
    // }

    // public static function getID($id) {
        
    //     $res = DB::table('hoteles')
    //         ->select('*')
    //         ->where('id', '=', $id)
    //         ->get();

    //     return $res;
    // }
}
