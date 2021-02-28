<?php

namespace App\Observers;

use App\Repositories\RepositoryInterface;
use App\Models\RepositoryFavorite;
use App\Services\Api\GitService;

class RepositoryFavoriteObserver
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function saving(RepositoryFavorite $favorite)
    {
        if (!is_null($existedFavorite = $this->checkForExisting($favorite))) {
            $this->attachToUser($existedFavorite);
            return false;
        }
        if (\Str::startsWith($favorite->html_url, GitService::GIT_URL)) {
            $favorite->html_url = GitService::getUrlPath($favorite->html_url);
        }
    }

    public function saved(RepositoryFavorite $favorite)
    {
        $this->attachToUser($favorite);
    }

    public function deleting(RepositoryFavorite $favorite)
    {
        if ($favorite->users()->count() > 1) {
            $this->detachFromUser($favorite);
            return false;
        }
    }

    protected function checkForExisting(RepositoryFavorite $favorite): ?RepositoryFavorite
    {
        return $this->repository->find($favorite, 'repo_id', $favorite->repo_id);
    }

    protected function attachToUser(RepositoryFavorite $favorite)
    {
        return $this->repository->attachOneToRelation($favorite, 'users', \Auth::id());
    }

    protected function detachFromUser(RepositoryFavorite $favorite)
    {
        return $this->repository->detachFromRelation($favorite, 'users', \Auth::id());
    }
}
