<?php

use Illuminate\Support\MessageBag;

if (!function_exists('page')) {
    function page($component, $props = [], $replaceDotsWithSlashes = true)
    {
        if ($replaceDotsWithSlashes) {
            $component = str_replace('.', '/', $component);
        }
        if (function_exists('inertia')) {
            return inertia($component, $props);
        }

        return view($component, $props);
    }
}

if (!function_exists('success')) {
    function success($message)
    {
        session()->flash('success', $message);
    }
}

if (!function_exists('fail')) {
    function fail($message)
    {
        session()->flash('error', $message);
    }
}

if (!function_exists('unvalidate')) {
    function unvalidate($key, $message)
    {
        $errorBag = new MessageBag;
        $errorBag->add($key, $message);

        return redirect()->back()->withInput(request()->input())->withErrors($errorBag);
    }
}

if (!function_exists('array_is_list')) {
    function array_is_list(array $arr)
    {
        if ($arr === []) {
            return true;
        }

        return array_keys($arr) === range(0, count($arr) - 1);
    }
}

if (!function_exists('bytes_for_humans')) {
    function bytes_for_humans(float $bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        $unit = $units[$i];

        if ($unit == 'B' || $unit == 'KB') {
            return ceil($bytes) . ' ' . $units[$i];
        }

        if ($unit == 'MB') {
            return round($bytes, 1) . ' ' . $units[$i];
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

if (!function_exists('data')) {
    function data(string $url)
    {
        return config('app.data_url') . DIRECTORY_SEPARATOR . $url;
    }
}

if (!function_exists('reload')) {
    function reload()
    {
        return redirect(request()->header('Referer'));
    }
}

if (!function_exists('omit')) {
    function omit($array, string|array $keys)
    {
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        return array_diff_key($array, array_flip($keys));
    }
}
