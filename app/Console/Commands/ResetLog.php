<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ResetLog extends \Illuminate\Console\Command
{
    protected $builder;
    protected $signature = "reset:log";
    protected $description = "Nhiệm vụ đặt lại nhật ký người dùng và nhật ký máy chủ";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        \App\Models\StatUser::where("record_at", "<", strtotime("-2 month", time()))->delete();
        \App\Models\StatServer::where("record_at", "<", strtotime("-2 month", time()))->delete();
        \App\Models\Log::where("created_at", "<", strtotime("-1 month", time()))->delete();
    }
}

?>