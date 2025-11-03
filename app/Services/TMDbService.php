<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TMDbService
{
    private string $apiKey;
    private string $baseUrl;
    private string $imageUrl;

    public function __construct()
    {
        $apiKey = config('services.tmdb.api_key');

        if (empty($apiKey)) {
            throw new Exception('TMDb API key is not configured. Please set TMDB_API_KEY in your environment variables.');
        }

        $this->apiKey = $apiKey;

        $baseUrl = config('services.tmdb.base_url');

        if (empty($baseUrl)) {
            throw new Exception('TMDb base URL is not configured. Please set TMDB_BASE_URL in your environment variables.');
        }

        $this->baseUrl = $baseUrl;

        $imageUrl = config('services.tmdb.image_url');

        if (empty($imageUrl)) {
            throw new Exception('TMDb image URL is not configured. Please set TMDB_IMAGE_URL in your environment variables.');
        }

        $this->imageUrl = $imageUrl;
    }

    public function getParameters(array $params = []): array
    {
        $params['api_key'] = $this->apiKey;
        $params['include_adult'] = config('services.tmdb.include_adult', false);
        $params['language'] = config('services.tmdb.language', 'en-US');
        return $params;
    }

    public function makeRequest(string $endpoint, array $params = []): array
    {
        $response = Http::get($this->baseUrl . $endpoint, $this->getParameters($params));

        if ($response->failed()) {
            Log::error('TMDb API Error', [
                'endpoint' => $endpoint,
                'params' => $params,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw new Exception('TMDb API request failed: ' . $response->body());
        }

        return $response->json();
    }

    public function imageUrl(string $imagePath, string $size = 'original'): string
    {
        return $this->imageUrl . $size . $imagePath;
    }

    public function getHttpClient(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withQueryParameters(['api_key' => $this->apiKey]);
    }
}
