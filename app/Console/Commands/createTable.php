<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class createTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化数据表';

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
        $log = "CREATE TABLE IF NOT EXISTS  `sm_log` (
            `id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
            `user_id`  int  NOT NULL COMMENT '用户id',
            `msg`  varchar(150)  COMMENT '日志信息',
            `data` varchar(200) COMMENT '日志数据',
            `created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
            PRIMARY KEY (`id`),
            KEY user_id (`user_id`)
            )ENGINE=InnoDB  DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        DB::statement($log);
        $this->info('create admin table success');
    }
}
