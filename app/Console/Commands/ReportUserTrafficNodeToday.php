<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ReportUserTrafficNodeToday extends \Illuminate\Console\Command
{
    protected $signature = "report:nodetraffictoday\n                            {--admin : Send report to admin only}\n                            {--user : Send report to user only}\n                            {id? : The ID of the server}";
    protected $description = "Report traffic node today";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = time();
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = $this->fetchTrafficData($_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_, $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_);
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = $this->buildTrafficReport($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_);
        $this->sendReport($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
        return 0;
    }
    private function fetchTrafficData($startAt, $endAt)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = ["shadowsocks" => \App\Models\ServerShadowsocks::where("parent_id", NULL)->get()->toArray(), "v2ray" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "trojan" => \App\Models\ServerTrojan::where("parent_id", NULL)->get()->toArray(), "vmess" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "vless" => \App\Models\ServerVless::where("parent_id", NULL)->get()->toArray(), "hysteria" => \App\Models\ServerHysteria::where("parent_id", NULL)->get()->toArray()];
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = \App\Models\StatServer::select(["server_id", "server_type", "u", "d", \Illuminate\Support\Facades\DB::raw("(u+d) as total")])->where("record_at", ">=", $startAt)->where("record_at", "<", $endAt)->where("record_type", "d")->limit(15)->orderBy("total", "DESC")->get()->toArray();
        foreach ($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_name"] = "Unknown";
            foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_type"]] as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["id"] === $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_id"]) {
                    $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_name"] = $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"];
                    $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] = number_format($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] / 1073741824, 2);
                }
            }
        }
        array_multisort(array_column($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_, "total"), SORT_DESC, $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_);
        return $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_;
    }
    private function buildTrafficReport($statistics)
    {
        if($this->argument("id") !== NULL) {
            $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ = $this->argument("id");
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("staff.aikopanel-id-" . $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ . ".app_name", "AikoPanel");
        } else {
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("aikopanel.app_name", "AikoPanel");
        }
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = "📮" . $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ . " - 🚄Thông Báo băng thông node sử dụng trong ngày hôm nay\n";
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "----\n";
        foreach ($statistics as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "  Name: " . $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["server_name"] . ", Total Traffic: " . $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["total"] . " GB\n";
        }
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "----\n";
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "📅 Thời gian: " . date("d-m-Y H:i") . "\n";
        return $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_;
    }
    private function sendReport($message)
    {
        $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ = $this->argument("id");
        if($this->argument("id") !== NULL) {
            $_obfuscated_0D1D38031E2E240D270B3B240939400514340E3C304001_ = new \App\Services\TelegramService("", $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_);
            $_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ = config("staff.aikopanel-id-" . $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ . ".interval_report_node_traffic_to_user_today");
            $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_ = config("staff.aikopanel-id-" . $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ . ".id_group_user_report_traffic_node_today");
            if($_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ !== NULL && 0 < $_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ && $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_ !== NULL) {
                $_obfuscated_0D1D38031E2E240D270B3B240939400514340E3C304001_->sendMessageWithGroup($message, $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_, $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_);
            }
        } else {
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
            $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_ = config("aikopanel.interval_report_node_traffic_to_admin_today");
            $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ = config("aikopanel.interval_report_node_traffic_to_user_today");
            $_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_ = config("aikopanel.id_group_admin_report_traffic_node_today");
            $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_ = config("aikopanel.id_group_user_report_traffic_node_today");
            if($this->option("admin") && $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_ !== NULL && 0 < $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_) {
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin($message);
                if($_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_ !== NULL) {
                    $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithGroup($message, $_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_);
                }
            }
            if($this->option("user") && $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ !== NULL && 0 < $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ && $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_ !== NULL) {
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithGroup($message, $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_);
            }
        }
    }
}

?>