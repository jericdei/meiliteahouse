<?php

namespace App\Services\Common;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload(string $path, File|UploadedFile $file, string|null $name): void
    {
        $filename = ($name ?: $file->getFilename()).'.webp';

        Storage::put(
            "$path/$filename",
            Image::make($file)
            ->encode('webp', 75)
        );
    }
}
