<?php

use Illuminate\Support\Str;

/**
 * Uploads an image file to the specified directory, optionally resizing it.
 *
 * @param \Illuminate\Http\UploadedFile $file The image file to be uploaded.
 * @param string $directory The directory where the file will be uploaded.
 * @param int|null $height Optional. The desired height of the image after resizing.
 * @param int|null $width Optional. The desired width of the image after resizing.
 *
 * @return string The file path of the uploaded image.
 *
 * @throws \Exception If an error occurs during the file upload process.
 */
function imageUpload($file, string $directory, $height = null, $width = null)
{
    try {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = public_path($directory);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        if ($height !== null && $width !== null) {
            $file->move($path, $filename);
        } else {
            $file->move($path, $filename);
        }
        $filePath = "{$directory}/{$filename}";
        return $filePath;
    } catch (\Exception $e) {
        throw $e;
    }
}
