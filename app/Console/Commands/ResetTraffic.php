<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ResetTraffic extends \Illuminate\Console\Command
{
    protected $signature = "reset:traffic";
    protected $description = "Nhiệm vụ đặt lại lưu lượng người dùng";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        ini_set("memory_limit", -1);
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::where("expired_at", "!=", NULL)->where("expired_at", ">", time())->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            $_obfuscated_0D232A271D010F2E27190A0D2D09030C5B22232D1C0C01_ = isset($user->reset_traffic_method) ? $user->reset_traffic_method : config("aikopanel.reset_traffic_method", 0);
            switch ($_obfuscated_0D232A271D010F2E27190A0D2D09030C5B22232D1C0C01_) {
                case 0:
                    $this->resetByMonthFirstDay($user);
                    break;
                case 1:
                    $this->resetByExpireDay($user);
                    break;
                case 2:
                case 3:
                    $this->resetByYearFirstDay($user);
                    break;
                case 4:
                    $this->resetByExpireYear($user);
                    break;
                case 5:
                    $this->resetEveryDay($user);
                    break;
            }
        }
    }
    private function resetByMonthFirstDay(\App\Models\User $user)
    {
        if((string) date("d") === "01") {
            $user->update(["u" => 0, "d" => 0]);
        }
    }
    private function resetByExpireDay(\App\Models\User $user)
    {
        $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ = date("d", strtotime("last day of +0 months"));
        $_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ = date("d", $user->expired_at);
        $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ = date("d");
        if($_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ === $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ || $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ === $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ && $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ <= $_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_) {
            $user->update(["u" => 0, "d" => 0]);
        }
    }
    private function resetByYearFirstDay(\App\Models\User $user)
    {
        if((string) date("md") === "0101") {
            $user->update(["u" => 0, "d" => 0]);
        }
    }
    private function resetByExpireYear(\App\Models\User $user)
    {
        $_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ = date("md", $user->expired_at);
        $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ = date("md");
        if($_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ === $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_) {
            $user->update(["u" => 0, "d" => 0]);
        }
    }
    private function resetEveryDay(\App\Models\User $user)
    {
        $user->update(["u" => 0, "d" => 0]);
    }
}

?>