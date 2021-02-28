<?php

namespace App\Http\Traits;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait RepositoryFormatable
{

    /**
     * @param RepositoryInterface $repository
     * @param Model $model
     * @param array $data
     * @return Collection
     */
    private function formatSearchData(RepositoryInterface $repository, Model $model, array $data): Collection
    {
        if (key_exists('items', $data)) {
            return collect($data['items'])->map( function($collection) use ($repository, $model) {
                $repositoryAlreadyExists = $repository->isExists($model, 'repo_id', $collection['id']);

                return collect($collection)
                    ->merge([
                        'is_exist'      => $repositoryAlreadyExists,
                        'user_has_repo' => $repositoryAlreadyExists
                            ? $repository->checkRelationByCondition(
                                \Auth::user(), 'repositoryFavorites','repo_id', $collection['id']
                            )
                            : false,
                        'owner_url'     => $collection['owner']['html_url'],
                        'owner_login'   => $collection['owner']['login'],
                        'repo_id'       => $collection['id'],
                    ])
                    ->only([
                        'repo_id', 'name', 'html_url', 'description', 'owner_login', 'stargazers_count',
                        'is_exist', 'owner_url', 'user_has_repo'
                    ]);
            });
        }

        return collect();
    }
}
