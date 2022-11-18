<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function loadListAdmin()
    {
        $data = $this->model::when(!(request()->has('sort') || request()->has('sort-by')), function ($query) {
            $query->orderBy('updated_at', 'desc');
        })
            ->sortBy(request('sort') ?? null, request('sort-by') ?? null)
            ->search(request('search') ?? null, ['name'])
            ->paginate(request('limit') ?? 5);

        $data->setCollection($data->getCollection()->makeHidden(['image']));
        return $data;
    }
}