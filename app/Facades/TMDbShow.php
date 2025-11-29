<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array searchShows(string $query, int $page = 1)
 * @method static array getShow(int $id)
 * @method static array getSeason(int $showId, int $seasonNumber, array $appendToResponse = [])
 * @method static array getEpisode(int $showId, int $seasonNumber, int $episodeNumber, array $appendToResponse = [])
 * @method static array getPopularTvShows(int $page = 1)
 * @method static array getTrendingTvShows(string $timeWindow = 'day', int $page = 1)
 * @method static array getGenres()
 *
 * @see \App\Services\TMDbShowService
 */
class TMDbShow extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\TMDbShowService::class;
    }
}
