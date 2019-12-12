<?php

namespace App\Transformers;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

abstract class Transformer {

    /**
     * Transform collections
     * @param Collection
     * @return array
     */
    public function collection(Collection $data)
    {   
        return [
            Str::plural($this->resourceName) => $data->map([$this, 'transform'])
        ];

    }

    /**
     * Transform a item
     * @return array
     */
    public function item($data)
    {
        return [
            $this->resourceName => $this->transform($data)
        ];
    }

    /**
     * Transform item
     */
    public abstract function transform($data);
}