<?php

namespace App\Listeners\File;

use App\Events\File\UploadFileEvent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadFileListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\File\UploadFileEvent  $event
     * @return void
     */
    public function handle(UploadFileEvent $event)
    {
        Storage::disk('google')->putFileAs('', $event->file, $event->nameFile);
    }
}