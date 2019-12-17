<?php

namespace App\Transformers;

class HotelsTransformer extends Transformer {

    protected $resourceName = 'hotels';


    public function transform($data)
    {
        $userTrans = new ProfileTransformer();
        
        return [
            'id'        => $data['id'],
            'slug'      => $data['slug'],
            'name'      => $data['name'],
            'stars'      => $data['stars'],
            'contry'  => $data['contry'],
            'company'  => $data['company'],
            'hotelUsu' => $userTrans->collection($data['usuarios'])
            ,
            // 'hotelUsu' => $data['usuarios'] ->transform($data['usuarios']),
            // 'hotelUsu'  => [
            // 'id'      => $data['usuarios'][0]['id'],
            //     // 'name'    => $data['employer']['name'],
            // ]
        ];
    }
}