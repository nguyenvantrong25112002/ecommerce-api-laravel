<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryInterface
{
    public function paginate($itemOnPage);

    /**
     * @return Collection|mixed
     */
    public function getAll();

    public function all($columns = ['*']);

    /**
     * Find data by id
     *
     * @param $id
     * @param  array  $columns
     * @return \Eloquent|mixed
     */
    public function find($id, $columns = ['*']);

    public function findOrFail($id);
    /**
     * Find multiple models by their primary keys.
     *
     * @param $ids
     * @param  string[]  $columns
     * @return mixed
     */
    public function findMany($ids, $columns = ['*']);

    public function getById($id);

    public function destroy($value);

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param  array  $condition
     * @param  array  $data
     * @return mixed
     */
    public function update(array $condition, array $data);

    /**
     * Update a entity in repository by id
     *
     * @param  array  $data
     * @param $id
     * @return mixed
     */
    public function updateById(array $data, $id);

    /**
     * @param  array  $attributes
     * @param  array  $value
     * @return mixed
     */
    public function updateOrCreate(array $attributes, $value = []);

    /**
     * whereSlug 
     *
     * @param $slug
     * @return mixed
     */
    public function whereSlug(string $slug);
}