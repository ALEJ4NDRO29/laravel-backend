<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $transformer = null;

    protected $errors = [];

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

    public function respondsBadRequest($msg = 'Bad Request') {
        return response($msg, 400, []);
    }

    public function reapondsUnauthorized($msg = 'Unauthorized') {
        return response($msg, 401, []);
    }

    public function respondsForbidden($msg = 'Forbidden')
    {
        return response($msg, 403, []);
    }

    public function respondsNotFound($msg = 'Not found')
    {
        return response($msg, 404, []);
    }

    public function respondsWithErrors($code)
    {
        return response($this->errors, $code, []);
    }

    protected function respondWithTransformer($data, $statusCode = 200, $headers = [])
    {
        if($this->transformer != null ) {
            if($data instanceof Collection) {
                $data = $this->transformer->collection($data);
            } else {
                $data = $this->transformer->item($data);
            }
            return response($data, $statusCode, $headers);
        } else {
            throw new Exception("Empty transformer", 1);
        }
    }

    protected function hasErrors()
    {
        return $this->errors != [];
    }

    protected function addError($err)
    {
        array_push($this->errors, $err);
    }
}
