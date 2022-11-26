<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getListAdmin()
    {
        $data = $this->model::orderBy('id', 'desc')
            ->whereNull('parent_id')
            ->withCount(['products'])
            ->with(['children' => function ($q) {
                return $q->withCount(['products']);
            }])
            ->paginate(request('limit') ?? 1);
        // $data->makeHidden(['view', 'token', 'description', 'details', 'image', 'quantity']);
        return  $data;
    }
    public function getParent()
    {
        return $this->model->whereNull('parent_id')->with('children')->get();
    }
}