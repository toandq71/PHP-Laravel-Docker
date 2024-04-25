<?php

namespace App\Helpers;

class Helpers
{
    public static function asset($url, $iscdn = false, $version = 'v2.61')
    {
        $fullurl = asset($url);

        return strpos($url, '?') !== false ? $fullurl.'&v='.$version : $fullurl.'?v='.$version;
    }

    public static function encryptSensitiveData($data)
    {
        if (strlen($data) < 6) {
            return '*****';
        }
        $start = substr($data, 0, 3);
        $end = substr($data, strlen($data) - 2, 2);

        return $start.'***'.$end;
    }

    /**
     * Check if string $haystack start with $needle.
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    public static function strStartWith($haystack, $needle): bool
    {
        if (! ($len = strlen($needle))) {
            return true;
        }

        return $haystack && (substr($haystack, 0, $len) === $needle);
    }
}
