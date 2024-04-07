<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AvatarService
{
    public static function generateAndDownloadAvatar(string $username)
    {
        $style = 'avataaars';
        $seed = Str::slug($username);
        $url = "https://avatars.dicebear.com/api/{$style}/{$seed}.svg";

        $response = Http::get($url);

        if ($response->successful()) {
            $avatarPath = 'avatars/' . $seed . '.svg';
            Storage::disk('public')->put($avatarPath, $response->body());

            return $avatarPath;
        }

        return null;
    }
}