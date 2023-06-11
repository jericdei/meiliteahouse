<?php

namespace App\Services\Common;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
