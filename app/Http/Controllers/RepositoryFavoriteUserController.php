<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryFavoriteUserAttachRequest;
use App\Http\Traits\Paginateable;
use App\Models\RepositoryFavorite;
use App\Models\User;
use App\Repositories\RepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RepositoryFavoriteUserController extends Controller
{
    use Paginateable, AuthorizesRequests;

    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository   = $repository;
    }

    public function favorites(User $user, Request $request)
    {
        $this->authorize('isOwn', $user);

        return view('favorites', [
            'repositories' => $this->paginate(
                $this->repository->getRelationData($user, 'repositoryFavorites'),
                RepositoryFavorite::DEFAULT_PAGINATION, $request->get('page'),
                route('users.repositories.favorites', $user)
            )
        ]);
    }

    public function addToFavorites(User $user, RepositoryFavoriteUserAttachRequest $request)
    {
        $this->repository
            ->attachOneToRelation($user, 'repositoryFavorites', $request->get('repository_favorite_id'));

        return redirect()->back();
    }
}
