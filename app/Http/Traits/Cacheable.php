<?php

namespace App\Http\Traits;

trait Cacheable
{
    /**
     * @param string $searchUrl
     * @param array $data
     * @param int $cacheTime
     * @return bool
     */
    public function cacheSearchResult(string $searchUrl, array $data, int $cacheTime): bool
    {
        return \Cache::add($searchUrl, $data, $cacheTime);
    }

    /**
     * @param string $searchUrl
     * @return mixed
     */
    public function checkSearchResult(string $searchUrl)
    {
        return \Cache::get($searchUrl);
    }
}
