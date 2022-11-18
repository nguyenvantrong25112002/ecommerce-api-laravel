<?php

namespace App\Listeners\Admin;

use App\Models\GalleryProducts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\File\DeleteFileEvent;
use App\Services\Traits\TUploadFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateGalleryProductListener
{

    use TUploadFile;
    public function __construct()
    {
    }


    public function handle($event)
    {
        $filenameArr = [];
        try {
            foreach ($event->gallerys as $key => $gallery) {
                if (isset($gallery['image'])) {
                    $filename =   $this->uploadFile($gallery['image']);
                    array_push($filenameArr, $filename);
                    GalleryProducts::create([
                        'image' =>   $filename,
                        'product_id' => $event->product_id,
                        'order' => $gallery['order']
                    ]);
                }
            }
        } catch (\Throwable $th) {
            if (count($filenameArr) > 0) {
                foreach ($filenameArr as $key => $filename) {
                    event(new DeleteFileEvent($filename));
                }
            }
        }
    }
}