<?php

namespace App\Facades;

use App\Http\Middleware\WithLayout;
use Illuminate\Support\Facades\Route as BaseRoute;
use function Illuminate\Filesystem\join_paths;

class Route extends BaseRoute
{
    public static function layout($component, $routes, $prefix = '/')
    {
        $middleware = WithLayout::class . ":" . $component;
        return static::prefix($prefix)->middleware($middleware)->group(function () use ($routes) {
            $routePath = join_paths("routes", $routes);
            require base_path($routePath);
        });
    }
}
