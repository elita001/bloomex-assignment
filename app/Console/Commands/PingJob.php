<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PingJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ping:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch PingJob ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \App\Jobs\PingJob::dispatch();
        return Command::SUCCESS;
    }
}
