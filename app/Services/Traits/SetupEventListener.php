<?php

namespace App\Services\Traits;

use Illuminate\Support\Str;
use App\Events\File\DeleteFileEvent;
use App\Events\File\UploadFileEvent;
use App\Listeners\File\DeleteFileListener;
use App\Listeners\File\UploadFileListener;

trait SetupEventListener
{
    public function  eventListener()
    {
    }
}