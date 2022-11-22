<?php

namespace App\Repositories\Eloquents;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model|\Eloquent $model */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    public function paginate($datas, $perPage = 10, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $datas = $datas instanceof Collection ? $datas : Collection::make($datas);
        return new LengthAwarePaginator($datas->forPage($page, $perPage)->values(), $datas->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }


    public function getAll()
    {
        return $this->model->all();
    }

    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findMany($ids, $columns = ['*'])
    {
        return $this->model->findMany($ids, $columns);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($value)
    {
        return $this->model->destroy($value);
    }

    public function delete($id)
    {
        $model = $this->findOrFail($id);
        return $model->delete();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $condition, array $data)
    {
        return $this->model->where($condition)->update($data);
    }

    public function updateById(array $data,  $id)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function updateOrCreate(array $attributes, $value = [])
    {
        return $this->model->updateOrCreate($attributes, $value);
    }

    public function whereSlug(string $slug)
    {
        return $this->model->whereSlug($slug)->firstOrFail();
    }

    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function whereMany($data)
    {
        $requests = [];
        foreach ($data as $key => $v) {
            array_push($requests, [$key => $v]);
        }
        return  $this->model::where([$requests]);
    }
}