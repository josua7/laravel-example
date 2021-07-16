<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Application as App;

class Application extends App
{
    /**
     * Returns whether the application is down for maintenance.
     *
     * Laravel maintenance mode is overridden to use the cache instead of the filesystem,
     * allowing us to treat Redis as a global distributed lock so that
     * maintenance mode is propagated to multiple servers.
     *
     * @return bool Whether the app is in maintenance mod.
     */
    public function isDownForMaintenance()
    {
        return Cache::has(MaintenanceMode::ON());
    }
}
