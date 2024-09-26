<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class SendRemindMail extends \Illuminate\Console\Command
{
    protected $signature = "send:remindMail";
    protected $description = "Gửi email nhắc nhở người dùng thanh toán";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::all();
        $_obfuscated_0D282E0A3940040C25265C033832193E0605193F211822_ = new \App\Services\MailService();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            if($user->remind_expire) {
                $_obfuscated_0D282E0A3940040C25265C033832193E0605193F211822_->remindExpire($user);
            }
            if($user->remind_traffic) {
                $_obfuscated_0D282E0A3940040C25265C033832193E0605193F211822_->remindTraffic($user);
            }
        }
    }
}

?>