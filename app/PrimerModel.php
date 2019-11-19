<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PrimerModel extends Model
{
    public static function getList() {
        // $id = Auth::user()->id;
        
        // $res = DB::table('notes')
        //             ->select('id', 'content')
        //             ->where('user_id', '=', $id)
        //             ->get();

        $res = DB::table('nueva_migration')
                    ->select('*')
                    ->get();

        return $res;
    }

    public static function getById($id) {
        $res = DB::table('nueva_migration')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->get();

        return $res;
    }
}
