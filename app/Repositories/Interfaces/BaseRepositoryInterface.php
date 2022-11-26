<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{

    public function paginate(array $datas, int $perPage, $page = null);

    public function getAll();

    public function all($columns = ['*']);

    public function find(int $id);

    public function findOrFail(int $id, $columns = ['*']);

    public function findMany(array $ids, $columns = ['*']);

    public function getById(int $id);

    public function destroy($value);

    public function delete(int $id);

    public function create(array $data);

    public function update(array $condition, array $data);

    public function updateById(array $data, int $id);

    public function updateOrCreate(array $attributes, array $value = []);

    public function whereSlug(string $slug);

    public function whereMany(array $data);
}