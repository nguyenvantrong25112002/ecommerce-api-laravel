<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PropertiesRepositoryInterface;

class PropertiesRepository extends BaseRepository implements PropertiesRepositoryInterface
{
    public function getListAdmin()
    {
        return $this->model::when(!(request()->has('sort') || request()->has('sort-by')), function ($query) {
            $query->orderBy('updated_at', 'desc');
        })
            ->sortBy(request('sort') ?? null, request('sort-by') ?? null)
            ->with(['species:species.id,species.name,species.properties_id'])->get();
    }
}