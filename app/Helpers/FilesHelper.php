<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesHelper
{
    public static function save(string $path, File $file): string
    {
        Storage::disk('public')->put($path, $file);

        return  $path . '/' . $file->hashName();
    }
}
