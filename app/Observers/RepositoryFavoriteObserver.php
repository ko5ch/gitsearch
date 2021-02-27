<?php

namespace App\Observers;

use App\Models\RepositoryFavorite;
use App\Services\Api\GitService;

class RepositoryFavoriteObserver
{
    public function saving(RepositoryFavorite $favorite)
    {
        if (\Str::startsWith($favorite->html_url, GitService::GIT_URL)) {
            $favorite->html_url = GitService::getUrlPath($favorite->html_url);
            $favorite->save();
        }
    }
}
