<?php

namespace App\Jobs;

use App\MaintenanceMode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class RunWorkflow implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mode = Cache::has(MaintenanceMode::ON()) ? 'true' : 'false';
        info('1 mode ' . $mode . ' ' . \Carbon\Carbon::now()->toDateTimeString());
        sleep(10);
        $mode = Cache::has(MaintenanceMode::ON()) ? 'true' : 'false';
        info('2 mode ' . $mode . ' ' . \Carbon\Carbon::now()->toDateTimeString());
        sleep(10);
        $mode = Cache::has(MaintenanceMode::ON()) ? 'true' : 'false';
        info('3 mode ' . $mode . ' ' . \Carbon\Carbon::now()->toDateTimeString());
        sleep(10);
        $mode = Cache::has(MaintenanceMode::ON()) ? 'true' : 'false';
        info('4 mode ' . $mode . ' ' . \Carbon\Carbon::now()->toDateTimeString());
    }
}
