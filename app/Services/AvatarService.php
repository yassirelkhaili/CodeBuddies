<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AvatarService
{
    public static function generateAndDownloadAvatar(string $username)
    {
        $style = 'fun-emoji';
        $seed = Str::slug($username);
        $url = "https://api.dicebear.com/8.x/{$style}/svg?seed={$seed}";

        $response = Http::get($url);

        if ($response->successful()) {
            $avatarPath = 'avatars/' . $seed . '.svg';
            Storage::disk('public')->put($avatarPath, $response->body());

            return $avatarPath;
        }

        return null;
    }
}