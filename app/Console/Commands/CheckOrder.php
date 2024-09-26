<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class CheckOrder extends \Illuminate\Console\Command
{
    protected $signature = "check:order";
    protected $description = "Nhiệm vụ kiểm tra đơn hàng";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        ini_set("memory_limit", -1);
        $_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ = \App\Models\Order::whereIn("status", [0, 1])->orderBy("created_at", "ASC")->get();
        foreach ($_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ as $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            \App\Jobs\OrderHandleJob::dispatch($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no);
        }
    }
}

?>