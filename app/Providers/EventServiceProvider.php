<?php

namespace App\Providers;

use App\Events\Subscribers\SubscriberCheckatEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Subscribers\SubscriberCheckatListener;
use App\Listeners\Campaigns\GiftvoucherListener;
use App\Jobs\Subscribers\SubscriberCheckatJob;
use App\Events\Campaigns\GiftvoucherCreated;
use App\Listeners\SendNewUserNotification;
use Illuminate\Auth\Events\Registered;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [

    ];

    public function boot(): void
    {
        parent::boot();
    }

    public function shouldDiscoverEvents(): bool
    {
        return true;
    }

}
