<?php

namespace App\Services\Traits;

use App\Events\File\DeleteFileEvent;
use App\Events\File\UploadFileEvent;
use App\Jobs\Admin\File\UploadFileJob;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait TUploadFile
{
    function uploadFile($file, $nameOld = null)
    {
        try {
            // dd($file);
            if (!$file) return false;
            if ($nameOld) event(new DeleteFileEvent($nameOld));
            $nameFile = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
            event(new UploadFileEvent($file, $nameFile));
            return $nameFile;
        } catch (\Throwable $th) {
            event(new DeleteFileEvent($nameFile));
            return false;
        }
    }
}