<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class TMDbShowService
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TMDbService();
    }

    public function searchShows(string $query, int $page = 1): array
    {
        return $this->tmdb->makeRequest('/search/tv', [
            'query' => $query,
            'page' => $page,
        ]);
    }

    public function getShow(int $id): array
    {
        return $this->tmdb->makeRequest("/tv/$id");
    }

    public function getSeason(int $showId, int $seasonNumber, array $appendToResponse = []): array
    {
        $cacheKey = "tmdb_tv_{$showId}_season_{$seasonNumber}_" . md5(serialize($appendToResponse));

        return Cache::remember($cacheKey, 3600, function () use ($showId, $seasonNumber, $appendToResponse) {
            $params = [];

            if (! empty($appendToResponse)) {
                $params['append_to_response'] = implode(',', $appendToResponse);
            }

            return $this->tmdb->makeRequest("/tv/{$showId}/season/{$seasonNumber}", $params);
        });
    }

    public function getEpisode(int $showId, int $seasonNumber, int $episodeNumber, array $appendToResponse = []): array
    {
        $cacheKey = "tmdb_tv_{$showId}_season_{$seasonNumber}_episode_{$episodeNumber}_" . md5(serialize($appendToResponse));

        return Cache::remember($cacheKey, 3600, function () use ($showId, $seasonNumber, $episodeNumber, $appendToResponse) {
            $params = [];

            if (! empty($appendToResponse)) {
                $params['append_to_response'] = implode(',', $appendToResponse);
            }

            return $this->tmdb->makeRequest("/tv/{$showId}/season/{$seasonNumber}/episode/{$episodeNumber}", $params);
        });
    }


    public function getPopularTvShows(int $page = 1): array
    {
        $cacheKey = "tmdb_popular_tv_page_{$page}";

        return Cache::remember($cacheKey, 1800, function () use ($page) {
            return $this->tmdb->makeRequest('/tv/popular', [
                'page' => $page,
            ]);
        });
    }

    public function getTrendingTvShows(string $timeWindow = 'day', int $page = 1): array
    {
        $cacheKey = "tmdb_trending_tv_{$timeWindow}_page_{$page}";

        return Cache::remember($cacheKey, 1800, function () use ($timeWindow, $page) {
            return $this->tmdb->makeRequest("/trending/tv/{$timeWindow}", [
                'page' => $page,
            ]);
        });
    }

    public function getGenres(): array
    {
        return Cache::remember('tmdb_tv_genres', 86400, function () {
            return $this->tmdb->makeRequest('/genre/tv/list');
        });
    }
}
