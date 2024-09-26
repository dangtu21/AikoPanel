<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class getAppleID extends \Illuminate\Console\Command
{
    protected $signature = "get:AppleID";
    protected $description = "Get Apple ID from idapple.aikocute.net and update cache";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $url = config("aikopanel.appleid_api");
        if(!$url) {
            $this->error("AppleID API URL is not set.");
            return 0;
        }
        if(strpos($url, "/share/") !== false) {
            $url = str_replace("/share/", "/shareapi/", $url);
        }
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = \Illuminate\Support\Facades\Http::get($url);
        if($_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->successful() && $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->json("status") && $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->json("code") == 200) {
            $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_ = $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->json("accounts");
            $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = "apple_ids";
            if(\Illuminate\Support\Facades\Cache::has($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_)) {
                \Illuminate\Support\Facades\Cache::forget($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_);
            }
            \Illuminate\Support\Facades\Cache::put($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_, now()->addminutes(5));
            $this->info("Apple IDs updated in cache at: " . now()->format("d-m-Y H:i:s"));
        } else {
            $this->error("Failed to fetch data from API.");
        }
        return 0;
    }
}

?>