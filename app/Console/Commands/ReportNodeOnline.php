<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ReportNodeOnline extends \Illuminate\Console\Command
{
    protected $signature = "report:nodeonline\n                            {--admin : Send report to admin only}\n                            {--user : Send report to user only}\n                            {id? : The ID of the server}";
    protected $description = "Report node online status to the server";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = (new \App\Services\ServerService())->getAllServers();
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = $this->buildOnlineReport($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
        $id = $this->argument("id");
        if($id !== NULL) {
            $_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ = config("staff.aikopanel-id-" . $id . ".interval_report_node_online_to_user_today");
            $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_ = config("staff.aikopanel-id-" . $id . ".id_group_user_report_node_online_today");
            if($_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ !== NULL && 0 < $_obfuscated_0D075C5B0127280F1B5B3E312916301F0D182B2A1F1A11_ && $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_ !== NULL) {
                $_obfuscated_0D1D38031E2E240D270B3B240939400514340E3C304001_ = new \App\Services\TelegramService("", $id);
                $_obfuscated_0D1D38031E2E240D270B3B240939400514340E3C304001_->sendMessageWithGroup($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_, $_obfuscated_0D102F0623363C0D240A330714260310402A1117362232_, $id);
            }
        } else {
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
            $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_ = config("aikopanel.interval_report_node_online_to_admin_today");
            $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ = config("aikopanel.interval_report_node_online_to_user_today");
            $_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_ = config("aikopanel.id_group_admin_report_node_online_today");
            $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_ = config("aikopanel.id_group_user_report_node_online_today");
            if($this->option("user") && $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ !== NULL && 0 < $_obfuscated_0D31062D1D1B2F031C0B020837020C0A073D3337133E32_ && $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_ !== NULL) {
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithGroup($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_, $_obfuscated_0D105C0B25392D2D140D293B251D193E2426072F3D0211_);
            }
            if($this->option("admin") && $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_ !== NULL && 0 < $_obfuscated_0D5B26391F073F5C5C070E3D1913033017240102281111_) {
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
                if($_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_ !== NULL) {
                    $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithGroup($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_, $_obfuscated_0D0D313230323D0F0811273427120C5C152C335B261E11_);
                }
            }
        }
        return 0;
    }
    private function buildOnlineReport($servers)
    {
        $_obfuscated_0D333C1F0F033C150A0C161C0D10271F1A061F1E331511_ = 0;
        if($this->argument("id")) {
            $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ = $this->argument("id");
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("staff.aikopanel-id-." . $_obfuscated_0D280D212E3406043531062D2706295C19193E04033B01_ . ".app_name", "AikoPanel");
        } else {
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("aikopanel.app_name", "AikoPanel");
        }
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = "📮" . $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ . " - 🚄Thông Báo Số Người Dùng\r\n----\r\n";
        foreach ($servers as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            if($this->shouldIncludeServer($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_)) {
                $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "   " . $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"] . ": " . $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["online"] . "\r\n";
                $_obfuscated_0D333C1F0F033C150A0C161C0D10271F1A061F1E331511_ .= $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["online"];
            }
        }
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "----\r\n";
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "📊 Tổng số người dùng: " . $_obfuscated_0D333C1F0F033C150A0C161C0D10271F1A061F1E331511_ . "\r\n";
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "----\r\n";
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "📅 Thời gian: " . date("d-m-Y H:i") . "\r\n";
        return $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_;
    }
    private function shouldIncludeServer($server)
    {
        return !$server["parent_id"] != 0 && $server["report"] != 0 && $server["show"] == 1;
    }
}

?>