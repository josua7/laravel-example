<?php

namespace App\Console\Commands;

use App\MaintenanceMode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Console\DownCommand as Down;

class DownCommand extends Down
{
    /**
     * Execute the console command.
     *
     * Overrides Laravel's DownCommand to use the cache instead of the
     * filesystem so that maintenance mode is propagated across all
     * servers and job queues.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::forever(MaintenanceMode::ON(), json_encode($this->getDownFilePayload()));
        $this->comment('Application is now in maintenance mode.');
    }
}
