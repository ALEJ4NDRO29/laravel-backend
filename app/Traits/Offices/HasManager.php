<?php

namespace App\Traits\Offices;

use App\Employer;
use App\Office;
use Error;

trait HasManager {
    
    /**
     * @param $office Office slug
     * @param $employer Employer id or "null" string
     * @return Office Office with changes
     */
    public static function setManager($office, $employer)
    {
        $officeModel = Office::query()->where('slug', $office)->firstOrFail();
        if($employer == "null") {
            $officeModel->employer_id = null;
        } else {
            $employerModel = Employer::query()->where('id', '=', $employer)->firstOrFail();
            $officeModel->employer_id = $employerModel->id;
        }

        $officeModel->save();
        return $officeModel;
    }

    public function isManager(Employer $employer) 
    {  
        return $this->manager == $employer;
    }

    public abstract function manager();

}
