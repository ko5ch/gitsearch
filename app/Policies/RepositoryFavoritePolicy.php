<?php

namespace App\Policies;

use App\Models\RepositoryFavorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepositoryFavoritePolicy
{
    use HandlesAuthorization;

    public function isOwn(User $user, RepositoryFavorite $favorite)
    {
        return $favorite->users->contains($user->id);
    }
}
