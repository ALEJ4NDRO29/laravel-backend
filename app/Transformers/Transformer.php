<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

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