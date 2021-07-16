<?php

namespace App\Console\Commands;

use App\MaintenanceMode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Console\UpCommand as Up;

class UpCommand extends Up
{
    /**
     * Execute the console command.
     *
     * Overrides Laravel's UpCommand to use the cache instead of the
     * filesystem so that maintenance mode is propagated across all
     * servers and job queues.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::forget(MaintenanceMode::ON());
        $this->info('Application is now live.');
    }
}
