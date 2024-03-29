<?php

namespace App\Http\Transformer;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

abstract class Transformer
{
    public abstract function transform($model);

    public function transformCollection(LengthAwarePaginator|Collection|SupportCollection $collection)
    {
        return $collection->map(fn ($model) => $this->transform($model));
    }
}
