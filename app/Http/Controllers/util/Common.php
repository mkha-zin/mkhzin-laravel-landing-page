<?php

namespace App\Http\Controllers\util;

use Illuminate\Support\Facades\File;

class Common
{
    public static function deleteImage($path): void
    {
        $file_path = public_path($path);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
    }

    public static function createSlug(): string
    {
        return fake()->regexify('[A-Za-z0-9]{20}');
    }


}
