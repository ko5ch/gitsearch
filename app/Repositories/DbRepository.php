<?php

namespace App\Repositories;

use App\Models\RepositoryFavorite;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DbRepository implements RepositoryInterface, RepositoryRelationInterface
{
    public function all(Model $model) :EloquentCollection
    {
        return $model::all();
    }

    public function find(Model $model, string $columnName, $value) :?Model
    {
        return $model::where($columnName, $value)->first();
    }

    public function getOrCreate(Model $model, Collection $data, Collection $searchBy) :Model
    {
        $searchColumns = $searchBy->map(function($columnName) use ($data) {
            return [$columnName => $data->get($columnName)];
        })->collapse();

        return $model::firstOrCreate($searchColumns->toArray(), $data->except($searchBy)->toArray());
    }

    public function store(Model $model, Collection $data) :Model
    {
        return $model::create($data->toArray());
    }

    public function delete(Model $model) :bool
    {
        return $model->delete();
    }

    public function isExists(Model $model, string $field, $value) :bool
    {
        return $model::where($field, $value)->exists();
    }

    public function create(Model $model, Collection $data)
    {
        return $model::create($data->toArray());
    }

    public function checkRelationByCondition(Model $model, string $relationName, string $field, $value, string $condition = '=') :bool
    {
        return $model->{$relationName}()->where($field, $condition, $value)->exists();
    }

    public function getRelationData(Model $model, string $relationName) :\Illuminate\Database\Eloquent\Collection
    {
        return $model->{$relationName}()->get();
    }

    public function attachOneToRelation(Model $model, string $relationName, int $relatedId, array $additionalData = [])
    {
        return $model->{$relationName}()->attach($relatedId, $additionalData);
    }

    /**
     * @param Model $model
     * @param string $relationName
     * @param int|array $relatedData
     * @return mixed
     */
    public function detachFromRelation(Model $model, string $relationName, $relatedData)
    {
        return $model->{$relationName}()->detach($relatedData);
    }

    public function getRelationCount(Model $model, string $relationName): int
    {
        return $model->{$relationName}()->count();
    }

    public function syncRelatedData(Model $model, string $relationName, array $data)
    {
        return $model->{$relationName}()->sync($data);
    }

    public function syncRelatedDataWithoutDetaching(Model $model, string $relationName, array $data)
    {
        return $model->{$relationName}()->syncWithoutDetaching($data);
    }
}
