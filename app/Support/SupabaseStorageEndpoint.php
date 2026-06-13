<?php

namespace App\Support;

class SupabaseStorageEndpoint
{
    public static function normalize(?string $endpoint): ?string
    {
        if (! $endpoint) {
            return $endpoint;
        }

        return preg_replace(
            '#^(https://[^./]+)\.supabase\.co(/storage/v1/s3/?(?:\?.*)?)$#',
            '$1.storage.supabase.co$2',
            $endpoint,
        );
    }
}
