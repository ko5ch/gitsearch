<?php

namespace App\Http\Traits;

use App\Services\Api\GitService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

trait Paginateable
{
    /**
     * @param array $total
     * @return int
     */
    public function getTotalRepositoriesCount(array $total): int
    {
        return isset($total['total_count'])
            ? ($total['total_count'] > GitService::MAX_TOTAL_RESULT ? GitService::MAX_TOTAL_RESULT : $total['total_count'] )
            : 0;
    }

    /**
     *
     * @param mixed $items
     * @param int $itemsCount
     * @param int $perPage
     * @param int $page
     * @param string $baseUrl
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginateRepositories($items, int $itemsCount, $perPage = 15, $page = null,  $baseUrl = null, $options = []): LengthAwarePaginator
    {
        $page = ( $itemsCount/$perPage > $page - 1 ? $page : $page - 1 ) ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items, $itemsCount, $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }

    /**
     *
     * @param array|Collection $items
     * @param int   $perPage
     * @param int  $page
     * @param string $baseUrl
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null,  $baseUrl = null, $options = []): LengthAwarePaginator
    {
        $page = ( $items->count()/$perPage > $page - 1 ? $page : $page - 1 ) ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }
}
