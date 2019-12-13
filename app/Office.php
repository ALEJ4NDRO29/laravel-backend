<?php

namespace App;

use App\Traits\Offices\HasManager;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasManager;
    // protected $primaryKey = 'slug';

    protected $fillable = [
        'name', 'location', 'slug'
    ];

    /**
     * @return Employer
     */
    public function manager()
    {
        return $this->hasOne(Employer::class, 'id', 'employer_id');
    }

}

