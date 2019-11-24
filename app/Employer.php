<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employer extends Model
{

    protected $fillable = [
        'name'
    ];


    public function office()
    {
        $this->hasMany('App\Office', 'id');
    }

}
