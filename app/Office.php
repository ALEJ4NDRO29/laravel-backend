<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    protected $fillable = [
        'name', 'location'
    ];

    // protected $hidden = [
    //     'created_at',
    // ];

    // protected $table = "offices";
}
