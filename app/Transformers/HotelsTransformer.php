<?php

namespace App\Transformers;

use App\Hotel;

class HotelsTransformer extends Transformer {

    protected $resourceName = 'hotels';

    public function transform($data)
    {
        return [
            'id'        => $data['id'],
            'slug'      => $data['slug'],
            'stars'      => $data['stars'],
            'contry'  => $data['contry'],
            'company'  => $data['company'],
            'hotelUsu' => UserTransformer::transforms($data['usuarios'])
            // 'hotelUsu'  => [
            // 'id'      => $data['usuarios'][0]['id'],
            //     // 'name'    => $data['employer']['name'],
            // ]
        ];
    }
}