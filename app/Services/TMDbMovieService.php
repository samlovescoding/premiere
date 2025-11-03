<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class TMDbMovieService
{
    private $tmdb;

    public function __construct()
    {
        $this->tmdb = new TMDbService();
    }

    public function searchMovies(string $query, int $page = 1): array
    {
        return $this->tmdb->makeRequest('/search/movie', [
            'query' => $query,
            'page' => $page,
        ]);
    }

    public function getMovie(int $id): array
    {
        return $this->tmdb->makeRequest("/movie/$id");
    }

    public function getPopularMovies(int $page = 1): array
    {
        $cacheKey = "tmdb_popular_movies_page_{$page}";

        return Cache::remember($cacheKey, 1800, function () use ($page) {
            return $this->tmdb->makeRequest('/movie/popular', [
                'page' => $page,
            ]);
        });
    }

    public function getTrendingMovies(string $timeWindow = 'day', int $page = 1): array
    {
        $cacheKey = "tmdb_trending_movies_{$timeWindow}_page_{$page}";

        return Cache::remember($cacheKey, 1800, function () use ($timeWindow, $page) {
            return $this->tmdb->makeRequest("/trending/movie/{$timeWindow}", [
                'page' => $page,
            ]);
        });
    }

    public function getGenres(): array
    {
        return Cache::remember('tmdb_movie_genres', 86400, function () {
            return $this->tmdb->makeRequest('/genre/movie/list');
        });
    }
}
