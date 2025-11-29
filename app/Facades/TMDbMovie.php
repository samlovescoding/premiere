<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array searchMovies(string $query, int $page = 1)
 * @method static array getMovie(int $id)
 * @method static array getPopularMovies(int $page = 1)
 * @method static array getTrendingMovies(string $timeWindow = 'day', int $page = 1)
 * @method static array getGenres()
 *
 * @see \App\Services\TMDbMovieService
 */
class TMDbMovie extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\TMDbMovieService::class;
    }
}
