<?php

namespace App\Providers;

use App\Events\Admin\CreateGalleryProductEvent;
use App\Events\File\DeleteFileEvent;
use App\Events\File\UploadFileEvent;
use App\Listeners\Admin\CreateGalleryProductListener;
use App\Listeners\File\DeleteFileListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\File\UploadFileListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        UploadFileEvent::class => [
            UploadFileListener::class,
        ],
        DeleteFileEvent::class => [
            DeleteFileListener::class,
        ],
        CreateGalleryProductEvent::class => [
            CreateGalleryProductListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}