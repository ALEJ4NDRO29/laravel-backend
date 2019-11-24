<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    protected $fillable = [
        'name', 'location'
    ];


    public function employer()
    {
        $this->hasOne('App\Employer', 'id');
    }

    // protected $hidden = [
    //     'created_at',
    // ];

    // protected $table = "offices";
}
