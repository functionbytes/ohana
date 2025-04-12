<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use App\Library\Log as MailLog;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
    }

}
