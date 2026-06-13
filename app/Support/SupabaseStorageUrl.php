<?php

namespace App\Support;

class SupabaseStorageUrl
{
    public static function normalize(?string $url, ?string $bucket): ?string
    {
        if (! $url || ! $bucket) {
            return $url;
        }

        $url = rtrim($url, '/');

        if (preg_match('#^https://[^/]+\.supabase\.co$#', $url)) {
            return $url.'/storage/v1/object/public/'.rawurlencode($bucket);
        }

        return $url;
    }
}
