<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $directory)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $request->file($fieldName)->storeAs('public/' . $directory . '/' . auth()->id(), $fileNameHash);
            return [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($path)
            ];
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $directory)
    {

        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/' . $directory . '/' . auth()->id(), $fileNameHash);
        return [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($path)
        ];
    }
}
