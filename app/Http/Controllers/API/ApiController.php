<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $transformer = null;

    public function generateSlug($key)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $lenght = 8;
        $randomString = '';
        for ($i = 0; $i < $lenght; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return Str::slug($key.'-'.$randomString);
    }

    public function reapondsUnauthorized($msg = 'Unauthorized'){
        return response($msg, 401, []);
    }

    protected function respondWithTransformer($data, $statusCode = 200, $headers = [])
    {
        // return $data;

        if($this->transformer != null ) {
            $data = $this->transformer->item($data);
            return response($data, $statusCode, $headers);
        }
    }

}
