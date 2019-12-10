<?php

namespace App\Transformers;

use App\Office;

class OfficesTransformer extends Transformer {

    protected $resourceName = 'office';

    public function transform($data)
    {
        return [
            'id'        => $data['id'],
            'slug'      => $data['slug'],
            'name'      => $data['name'],
            'location'  => $data['location'],
            'employer'  => [
                'id'      => $data['employer']['id'],
                'name'    => $data['employer']['name'],
            ]
        ];
    }

}