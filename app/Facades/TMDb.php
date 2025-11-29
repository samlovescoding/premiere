<?php

namespace App\Facades;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getParameters(array $params = [])
 * @method static array makeRequest(string $endpoint, array $params = [])
 * @method static string imageUrl(string $imagePath, string $size = 'original')
 * @method static PendingRequest getHttpClient()
 *
 * @see \App\Services\TMDbService
 */
class TMDb extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\TMDbService::class;
    }
}
