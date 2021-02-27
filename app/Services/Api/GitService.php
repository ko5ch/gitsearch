<?php

namespace App\Services\Api;

use App\Http\Traits\Cacheable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

class GitService
{
    use Cacheable;

    const GIT_API_URL                   = 'https://api.github.com/';
    const GIT_URL                       = 'https://github.com/';
    const MAX_TOTAL_RESULT              = 1000; //To satisfy that need, the GitHub Search API provides up to 1,000 results for each search. (c)
    protected const DEFAULT_CACHE_TIME  = 30;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string|null $query
     * @param int $page
     * @param int $perPage
     * @param string|null $sort
     * @param string|null $order
     * @return array
     */
    public function search(?string $query, int $page = 1, int $perPage = 10, ?string $sort = 'stars', ?string $order = 'desc'): array
    {
        $url = "search/repositories?";
        $url .= "q={$query}";
        $url .= "&per_page={$perPage}";
        $url .= "&order={$order}";
        $url .= "&page={$page}";
        $url .= "&sort={$sort}";
        $data = [];

        try {
            if (\Str::length($query) && is_null($data = $this->checkSearchResult($url))) {
                $response = $this
                    ->client
                    ->request('GET', \Str::start($url, self::GIT_API_URL));

                $data = json_decode($response->getBody(), true);
                $this->cacheSearchResult($url, $data, self::DEFAULT_CACHE_TIME);
            }
        } catch (GuzzleException $e) {
            report($e);
        }

        return $data ?? [];
    }

    /**
     * @return Collection
     */
    public static function getDefaultSearchValues(): Collection
    {
        return collect(['search_text' => '+', 'per_page' => 10, 'sort' => 'stars', 'order' => 'desc', 'page' => 1]);
    }

    /**
     * @param string $url
     * @return string
     */
    public static function getUrlPath(string $url) :string
    {
        return \Str::of($url)->after(self::GIT_URL)->__toString();
    }
}
