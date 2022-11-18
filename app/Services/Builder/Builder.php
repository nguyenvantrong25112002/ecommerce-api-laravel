<?php

namespace App\Services\Builder;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class Builder extends  EloquentBuilder
{
    public function parentCategory()
    {
        return $this->where('parent_id', 0);
    }

    /**
     * Has request url
     */
    public function hasRequest($data = [])
    {
        if (count($data) == 0) return $this;
        $q = $this;
        foreach ($data as $key => $v) {
            if ($v) $q = $q->where($key, $v);
        }
        return $q;
    }
    public function sortBy($sort, $sortBy)
    {
        if (is_null($sort) || is_null($sortBy)) return $this;
        $this->orderBy($sortBy, $sort);
        return $this;
    }

    public function search($request, $columns = [])
    {
        if (is_null($request) || count($columns) == 0) return $this;
        $this->where($columns[0], 'LIKE', "%" . $request . "%");
        foreach ($columns as $key => $column) {
            if ($key !== 0) $this->orWhere($column, 'LIKE', "%" . $request . "%");
        }
        return $this;
    }
}