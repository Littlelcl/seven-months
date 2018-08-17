<?php

namespace App\Console\Commands;

use App\Jobs\LogWriter;
use Illuminate\Console\Command;
use App\Services\Queue\CustomQueue;

class CustomFork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:fork {number = 0} {blocking=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $cmdWait = 'ps axu|grep "resque : Waiting for customFork"|grep -v "grep "|wc -l';
            $retWait = shell_exec($cmdWait);
            $resWait = rtrim($retWait, "\r\n");

            $cmdPaused = 'ps axu|grep "resque : Paused customFork"|grep -v "grep"|wc -l';
            $retPaused = shell_exec($cmdPaused);
            $resPaused = rtrim($retPaused, "\r\n");

            $cmdProcess = 'ps axu|grep "resque : Processing customFork"|grep -v "grep"|wc -l';
            $retProcess = shell_exec($cmdProcess);
            $resProcess = rtrim($retProcess, "\r\n");

            if($resWait === "0" && $resPaused === "0" && $resProcess === "0") {
                $count = $_SERVER['argv'][2] ?? 3;
                $BLOCKING = $_SERVER['argv'][4] ?? false;
                if($count > 1) {
                    for($i = 0; $i < $count; ++$i) {
                        $pid = CustomQueue::fork();
                        if($pid === false || $pid === -1) {
                            LogWriter::dispatch(storage_path('logs/fork/info.log'), "Could not fork worker {$count}");
                        } else if(!$pid) {
                            $worker = new CustomQueue();
                            $interval = 5;
                            $worker->work($interval, $BLOCKING);
                        }
                    }
                }
// Start a single worker
                else {
                    $worker = new CustomQueue();
                    $interval = 5;
                    $worker->work($interval, $BLOCKING);
                }
            }
        }catch(\Exception $e){
            LogWriter::dispatch(storage_path('logs/fork/info.log'), $e->getMessage(), $e->getTrace());
        }
    }
}
