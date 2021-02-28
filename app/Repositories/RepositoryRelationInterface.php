<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryRelationInterface
{
    public function checkRelationByCondition(Model $model, string $relationName, string $relationField, $value, string $condition) :bool;
    public function getRelationData(Model $model, string $relationName) :Collection;
    public function attachOneToRelation(Model $model, string $relationName, int $relatedId, array $additionalData);
    public function detachFromRelation(Model $model, string $relationName, $relatedData); //$relatedData int|array, available only from PHP 8.0
    public function getRelationCount(Model $model, string $relationName) :int;
    public function syncRelatedData(Model $model, string $relationName, array $data);
    public function syncRelatedDataWithoutDetaching(Model $model, string $relationName, array $data);
}
