<?php
/**
 * Created by PhpStorm.
 * User: zhaozemin
 * Date: 2018/8/17
 * Time: 16:09
 */

namespace App\Services\Queue;
use App\Services\Redis\QueueRedis;
use App\Jobs\LogWriter;

class CustomQueue
{
    public $shutdown = false;
    public $paused = false;
    public $queue;  //任务队列
    public $queueError;  //无法处理的任务队列
    public $keyError;  //无法处理的任务计数key
    public $redis;
    public $child;
    const  DEFAULT_INTERVAL = 5;

    public function __construct(QueueRedis $redis)
    {
        $this->queue = 'queue_test';
        $this->redis = $redis;
    }

    public static function fork()
    {
        if(!function_exists('pcntl_fork')) {
            return false;
        }

        // Close the connection to Redis before forking.
        // This is a workaround for issues phpredis has.
//        self::$redis = null;

        $pid = pcntl_fork();
        if($pid === -1) {
            LogWriter::dispatch(storage_path('logs/fork/info.log'), 'Unable to fork child worker.');
        }

        return $pid;
    }

    public function work($interval = self::DEFAULT_INTERVAL, $blocking = false)
    {
        LogWriter::dispatch(storage_path('logs/fork/info.log'), 'Workers has started!.');
//        $this->updateProcLine('Starting');
        $this->startup();

        while(true) {
            $this->patchSignal();

            if($this->shutdown) {
                break;
            }

            // Attempt to find and reserve a job
            $job = false;
            if(!$this->paused) {
                $this->updateProcLine('Waiting for ' .$this->queue);

                $job = $this->reserve($blocking, $interval);
            }

            if(!$job) {

                if($blocking === false)
                {
                    // If no job was found, we sleep for $interval before continuing and checking again
                    if($this->paused) {
                        $this->updateProcLine('Paused ' .  $this->queue);
                    }
                    else {
                        $this->updateProcLine('Waiting for ' .  $this->queue);
                    }
                    usleep($interval * 1000000);
                }
                continue;
            }
            $status = 'Processing ' . $this->queue;
            $this->updateProcLine($status);
            $this->perform($job);
        }

    }

    private function startup()
    {
        $this->registerSigHandlers();
    }

    private function registerSigHandlers(){
        if(!function_exists('pcntl_signal')) {
            return;
        }

        pcntl_signal(SIGTERM, function (){
            $this->shutdown = true;
        });
        pcntl_signal(SIGINT, function (){
            $this->shutdown = true;
        });
        pcntl_signal(SIGQUIT, function (){
            $this->shutdown = true;
        });
        pcntl_signal(SIGUSR2, function (){
            $this->paused = true;
        });
        pcntl_signal(SIGCONT, function (){
            $this->paused = false;
        });
    }

    private function patchSignal(){
        if(!function_exists('pcntl_signal_dispatch')) {
            return;
        }
        pcntl_signal_dispatch();
    }

    private function updateProcLine($status)
    {
        $processTitle = 'resque : ' . $status;
        if(function_exists('cli_set_process_title') && PHP_OS !== 'Darwin') {
            cli_set_process_title($processTitle);
        }
        else if(function_exists('setproctitle')) {
            setproctitle($processTitle);
        }
    }

    public function reserve($blocking = false, $timeout = null)
    {
        if($blocking === true) {
            $job = $this->redis->blockPopQueueUser($timeout);
            if($job) return $job;
        } else {
            $job = $this->redis->popQueueUser();
            if($job) return $job;
        }
        return false;
    }

    public function perform($json_job){

        try{
            $json_job = json_decode($json_job);
            self::$resqueInstance->rollbackToQueue($json_job);
//            if ($this->redis->setQueueUser($json_job['id'], $json_job) === false){
//                self::$resqueInstance->rollbackToQueue($json_job);
//            }
//

        }catch (\Exception $e){
//            self::$resqueInstance->rollbackToQueue($json_job);
            LogWriter::dispatch(storage_path('logs/fork/info.log'), $e->getMessage(), $e->getTrace());
        }
    }
}