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

    public function getActive()
    {
        $data = $this->model::query();
        $data->orderBy('order', 'desc');
        $data->where('status', config('util.ACTIVE_STATUS'));
        return $data;
    }

    public function getListApi()
    {
        $data = $this->getActive();
        $data->orderBy('order', 'desc');
        $data->whereNull('parent_id');
        $data->where('status', config('util.ACTIVE_STATUS'));
        $data = $data->get();
        return $data;
    }
}