<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryFavoriteRequest;
use App\Http\Requests\RepositorySearchRequest;
use App\Http\Traits\Paginateable;
use App\Http\Traits\RepositoryFormatable;
use App\Repositories\RepositoryInterface;
use App\Models\RepositoryFavorite;
use App\Services\Api\GitService;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    use Paginateable, RepositoryFormatable;

    protected RepositoryInterface $repository;
    protected RepositoryFavorite $model;
    protected GitService $service;

    public function __construct(RepositoryInterface $repository, RepositoryFavorite $favorite, GitService $gitService)
    {
        $this->repository   = $repository;
        $this->service      = $gitService;
        $this->model        = $favorite;
    }

    public function index(RepositorySearchRequest $request)
    {
        $repositories = $this->service->search(
            $request->get('search_text'), $request->get('page'), $request->get('per_page'),
            $request->get('sort'), $request->get('order')
        );
        $totalCount = $this->getTotalRepositoriesCount($repositories);

        return view('repositories', [
            'repositories'  => $this->paginateRepositories(
                $this->formatSearchData($this->repository, $this->model, $repositories), $totalCount,
                $request->get('per_page'), $request->get('page'), route('repositories.search'),
                $request->only(['sort', 'order'])
            ),
        ]);
    }

    public function favorites(Request $request)
    {
        return view('favorites', [
            'repositories' => $this->paginate(
                $this->repository->all($this->model),RepositoryFavorite::DEFAULT_PAGINATION,
                $request->get('page'), route('repositories.favorites')
            )
        ]);
    }

    public function store(RepositoryFavoriteRequest $request)
    {
        $favorite = $this->repository->getOrCreate(
            $this->model, collect($request->validated()),
            collect(RepositoryFavorite::STORE_UNIQUE_FIELD)
        );

        return redirect()->back();
    }

    public function delete(RepositoryFavorite $favorite)
    {
        $this->repository->delete($favorite);

        return redirect()->back();
    }
}
