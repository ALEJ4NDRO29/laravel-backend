<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    // protected $primaryKey = 'slug';

    protected $fillable = [
        'name', 'location', 'slug'
    ];


    public function employer()
    {
        $this->hasOne('App\Employer', 'id');
    }

}

