<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getList($request = [], $with = [])
    {
        $data = $this->model::orderBy('id', 'desc')
            ->whereNull('parent_id')
            ->hasRequest($request)
            ->withCount(['products'])
            ->with($with)
            ->paginate(request('limit') ?? 1);
        // $data->makeHidden(['view', 'token', 'description', 'details', 'image', 'quantity']);
        return  $data;
    }
    public function getParent()
    {
        return $this->model->whereNull('parent_id')->with('children')->get();
    }
}