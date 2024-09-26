<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ResetAppleIDLimit extends \Illuminate\Console\Command
{
    protected $signature = "reset:appleidlimit";
    protected $description = "Reset Apple ID Limit";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ = \App\Models\Plan::whereNotNull("appleid_limit")->get();
        foreach ($_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ as $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
            \App\Models\User::where("plan_id", $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id)->whereNotNull("appleid_limit")->update(["appleid_limit" => $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit]);
        }
        return 0;
    }
}

?>