<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\AssignOp\Mod;

interface RepositoryInterface
{
    public function getOrCreate(Model $model, Collection $data, Collection $searchBy);
    public function isExists(Model $model, string $field, $value) :bool;
    public function create(Model $model, Collection $data);
    public function store(Model $model, Collection $data);
    public function delete(Model $id);
    public function all(Model $model);
}
