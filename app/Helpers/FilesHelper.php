<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesHelper
{
    public static function save(string $path, File $file): string
    {
        $path = $path . '/' . Str::snake($file->hashName());
        Storage::put($path, $file);
        return $path;
    }
}
