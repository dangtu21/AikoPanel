<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class CheckServer extends \Illuminate\Console\Command
{
    protected $signature = "check:server";
    protected $description = "Nhiệm vụ kiểm tra nút";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = (new \App\Services\ServerService())->getAllServers();
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = $this->generateOfflineReport($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
        if(!empty($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_)) {
            (new \App\Services\TelegramService())->sendMessageWithAdmin($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
        }
        if(config("aikopanel.auto_stop_node")) {
            $this->checkAndShutdownServers($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
        }
    }
    private function generateOfflineReport($servers)
    {
        $_obfuscated_0D22331E1E2216032911342123132E22131E3E5B3E1D32_ = 0;
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = "📮 Thông báo ngoại tuyến của nút\r\n----\r\n";
        foreach ($servers as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            if($this->shouldSkipServer($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_)) {
            } else {
                $address = $this->getServerAddress($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_);
                if($this->isServerOffline($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_, $address)) {
                    $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= $this->formatServerMessage($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_, $address, "🔴");
                    $_obfuscated_0D22331E1E2216032911342123132E22131E3E5B3E1D32_++;
                    $this->cacheReportTime($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_);
                } elseif($this->isServerPotentiallyOffline($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_, $address)) {
                    $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= $this->formatServerMessage($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_, $address, "🟡");
                    $_obfuscated_0D22331E1E2216032911342123132E22131E3E5B3E1D32_++;
                    $this->cacheReportTime($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_);
                }
            }
        }
        return 0 < $_obfuscated_0D22331E1E2216032911342123132E22131E3E5B3E1D32_ ? $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ . "\nTổng số server không hoạt động: " . $_obfuscated_0D22331E1E2216032911342123132E22131E3E5B3E1D32_ : "";
    }
    private function shouldSkipServer($server)
    {
        return $server["parent_id"] || $server["report"] == 0;
    }
    private function getServerAddress($server)
    {
        $address = $server["host"];
        if(filter_var($address, FILTER_VALIDATE_IP) === false) {
            $address = gethostbyname($server["host"]);
        }
        return $address;
    }
    private function isServerOffline($server, $address)
    {
        return $server["available_status"] == 0;
    }
    private function isServerPotentiallyOffline($server, $address)
    {
        return $server["available_status"] == 1 && !$this->pingtcp($address, $server["port"]);
    }
    private function formatServerMessage($server, $address, $statusIcon)
    {
        return sprintf("%s %s - %s -ID:%s - IP: %s\r\n", $statusIcon, $server["name"], $server["type"], $server["id"], $server["ip"] ?? $address);
    }
    private function pingtcp($ip, $port)
    {
        $connection = @fsockopen($ip, $port, $_obfuscated_0D251F291A332B051B320A112E1A5C403E050313325C01_, $_obfuscated_0D2726121E1A263736072A391C1D06330529351E2A3B11_, 5);
        if(is_resource($connection)) {
            fclose($connection);
            return true;
        }
        return false;
    }
    private function checkAndShutdownServers($servers)
    {
        $_obfuscated_0D1212031E402E1C16351D0F2532141F37192A2B193C32_ = time();
        foreach ($servers as $server) {
            $key = "server_report_time_" . $server["id"] . "_" . $server["type"];
            $_obfuscated_0D39133E260C5B0F28223908281D21361D131832372522_ = \Illuminate\Support\Facades\Cache::get($key);
            if($_obfuscated_0D39133E260C5B0F28223908281D21361D131832372522_ && 1800 < $_obfuscated_0D1212031E402E1C16351D0F2532141F37192A2B193C32_ - $_obfuscated_0D39133E260C5B0F28223908281D21361D131832372522_) {
                $this->updateServerStatus($server);
                \Illuminate\Support\Facades\Cache::forget($key);
            }
        }
    }
    private function cacheReportTime($server)
    {
        $key = "server_report_time_" . $server["id"] . "_" . $server["type"];
        $value = time();
        \Illuminate\Support\Facades\Cache::put($key, $value, 3600);
    }
    private function updateServerStatus($server)
    {
        $_obfuscated_0D22221A1A3F23401B021F2C0B042F0E22390A15051E32_ = "v2_server_" . $server["type"];
        \Illuminate\Support\Facades\DB::table($_obfuscated_0D22221A1A3F23401B021F2C0B042F0E22390A15051E32_)->where("id", $server["id"])->update(["show" => 0, "report" => 0]);
    }
}

?>