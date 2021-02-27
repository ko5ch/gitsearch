<?php

namespace App\Repositories;

use App\Models\RepositoryFavorite;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DbRepository implements RepositoryInterface
{
    public function all(Model $model) //:collection
    {
        return $model::all();
    }

    public function getOrCreate(Model $model, Collection $data, Collection $searchBy) //:model
    {
        $searchColumns = $searchBy->map(function($columnName) use ($data) {
            return [$columnName => $data->get($columnName)];
        })->collapse();

        return $model::firstOrCreate($searchColumns->toArray(), $data->except($searchBy)->toArray());
    }

    public function store(Model $model, Collection $data) //:model
    {
        return $model::create($data->toArray());
    }

    public function delete(Model $id) //:bool
    {
        return $id->delete();
    }

    public function isExists(Model $model, string $field, $value) :bool
    {
        return $model::where($field, $value)->exists();
    }
}
