<?php

namespace App\Transformers;

use App\Office;

class UserTransformer extends Transformer {

    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'email'     => $data['email'],
            'token'     => $data['token'],
            'username'  => $data['username']
        ];
    }

    public function transforms($data) {
        $pila = array();

        foreach($data as $user){
            array_push($pila, ['username'=> $user['username']]);
        }
        return $this->collection($data);
    }
}