<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ResetUser extends \Illuminate\Console\Command
{
    protected $builder;
    protected $signature = "reset:user";
    protected $description = "Nhiệm vụ đặt lại thông tin an toàn người dùng";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        if(!$this->confirm("Bạn có chắc chắn đặt lại tất cả thông tin bảo mật người dùng?")) {
            return NULL;
        }
        ini_set("memory_limit", -1);
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::all();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            $user->token = \App\Utils\Helper::guid();
            $user->uuid = \App\Utils\Helper::guid(true);
            $user->save();
            $this->info("Có người dùng đặt lại " . $user->email . " Thông tin bảo mật thành công");
        }
    }
}

?>