<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class SendRemindTele extends \Illuminate\Console\Command
{
    protected $signature = "send:remindTele";
    protected $description = "Gửi nhắc nhở thanh toán qua telegram";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::all();
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->remindExpire($user);
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->remindTraffic($user);
        }
        return 0;
    }
}

?>