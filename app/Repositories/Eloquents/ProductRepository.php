<?php

namespace App\Repositories\Eloquents;

use App\Http\Resources\ProductResource;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function dataResourceCollectionPaginate($datas)
    {
        return  ProductResource::collection($datas)->response()->getData(true);
    }

    protected function dataResourceCollection($datas)
    {
        return  ProductResource::collection($datas);
    }
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
    protected  function loadActive()
    {
        $data = $this->model::query();
        $data->where('status', config('util.ACTIVE_STATUS'));
        return $data;
    }



    public function getNew()
    {
        $datas = $this->loadActive()->orderBy('updated_at', 'DESC')->limit(5)->get();

        return $this->dataResourceCollection($datas);
    }

    public function getSale()
    {
        $datas = $this->loadActive()
            ->where('sale_off', '>', 0)
            ->orderBy('sale_off', 'DESC')
            ->limit(8)
            ->get();
        return $this->dataResourceCollection($datas);
    }

    public function showApi($slug)
    {
        $data = $this->model::whereSlug($slug)
            ->first()
            ->load(['gallerys', 'properties', 'species']);
        return $data;
    }

    public function getExceptInByID($id, $id_array)
    {
        $datas = $this->model::where(function ($q) use ($id, $id_array) {
            $q->whereNot('id', $id);
            $q->whereIn('id', $id_array);
            return $q;
        })->get()->take(5);
        return $this->dataResourceCollection($datas);
    }
}