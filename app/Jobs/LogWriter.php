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

    /**
     * @param string $path
     */
    private  $path;
    /**
     * @param string $msg
     */
    private $msg;
    /**
     * @param array $data
     */
    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $path = '', string $msg = '', array $data=[])
    {
        $this->path = $path;
        $this->msg = $msg;
        $this->data = $data;
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
        Log::useDailyFiles(storage_path($this->path));
        Log::info($this->msg, $this->data);
    }
}
