<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class LogWriter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $queueName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $monolog = Log::getMonolog();
        $monolog->popHandler();
        Log::useDailyFiles(storage_path('logs/job/info.log'));
        Log::info($this->queueName.microtime(true));
    }
}
