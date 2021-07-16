<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Horizon\Contracts\MasterSupervisorRepository;
use Laravel\Horizon\MasterSupervisor;
use Symfony\Component\Console\Command\SignalableCommandInterface;

class HorizonPause extends Command implements SignalableCommandInterface
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizonpause';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pause the master supervisor';

    /**
     * Get the list of signals handled by the command.
     *
     * @return array
     */
    public function getSubscribedSignals(): array
    {
        return [SIGINT, SIGTERM];
    }

    /**
     * Handle an incoming signal.
     *
     * @param  int  $signal
     * @return void
     */
    public function handleSignal(int $signal): void
    {
        $this->pause();
    }

    public function handle()
    {
        return 0;
    }

    /**
     * Execute the console command.
     *
     * @param  \Laravel\Horizon\Contracts\MasterSupervisorRepository  $masters
     * @return void
     */
    public function pause(MasterSupervisorRepository $masters)
    {
        $masters = collect($masters->all())->filter(function ($master) {
            return Str::startsWith($master->name, MasterSupervisor::basename());
        })->all();

        foreach (Arr::pluck($masters, 'pid') as $processId) {
            $this->info("Sending USR2 Signal To Process: {$processId}");

            if (! posix_kill($processId, SIGUSR2)) {
                $this->error("Failed to kill process: {$processId} (".posix_strerror(posix_get_last_error()).')');
            }
        }
    }
}
