<?php

namespace App\Transformers;

class ProfileTransformer extends Transformer {

    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'username'  => $data['username']
        ];
    }

    public static function transforms($data) {
        $pila = array();

        foreach($data as $user){
            array_push($pila, ['username'=> $user['username']]);
        }
        return $this->collection($data);
    }
}