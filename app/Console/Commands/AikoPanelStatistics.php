<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AikoPanelStatistics extends \Illuminate\Console\Command
{
    protected $signature = "aikopanel:statistics";
    protected $description = "Nhiệm vụ thống kê";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = microtime(true);
        ini_set("memory_limit", -1);
        $this->stat();
        info("Nhiệm vụ thống kê được hoàn thành, mất thời gian:" . (microtime(true) - $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_) / 1000 . "s");
    }
    private function statServer()
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_ = time();
            $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_ = strtotime("-1 day", strtotime(date("d-m-Y")));
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_ = new \App\Services\StatisticalService();
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->setStartAt($_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_);
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->setServerStats();
            $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->getStatServer();
            foreach ($_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ as $stat) {
                if(!\App\Models\StatServer::insert(["server_id" => $stat["server_id"], "server_type" => $stat["server_type"], "u" => $stat["u"], "d" => $stat["d"], "created_at" => $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_, "updated_at" => $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_, "record_type" => "d", "record_at" => $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_])) {
                    throw new \Exception("stat server fail");
                }
            }
            \Illuminate\Support\Facades\DB::commit();
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->clearStatServer();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            \Log::error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage(), ["exception" => $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_]);
        }
    }
    private function statUser()
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_ = time();
            $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_ = strtotime("-1 day", strtotime(date("d-m-Y")));
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_ = new \App\Services\StatisticalService();
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->setStartAt($_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_);
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->setUserStats();
            $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->getStatUser();
            foreach ($_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ as $stat) {
                if(!\App\Models\StatUser::insert(["user_id" => $stat["user_id"], "u" => $stat["u"], "d" => $stat["d"], "server_rate" => $stat["server_rate"], "created_at" => $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_, "updated_at" => $_obfuscated_0D182418051528210E2D08192C2C3E08022904342B3C22_, "record_type" => "d", "record_at" => $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_])) {
                    throw new \Exception("stat user fail");
                }
            }
            \Illuminate\Support\Facades\DB::commit();
            $_obfuscated_0D0F1A2A3D362F081110093C33332D2F19223137043511_->clearStatUser();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            \Log::error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage(), ["exception" => $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_]);
        }
    }
    private function stat()
    {
        try {
            $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = strtotime(date("d-m-Y"));
            $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime("-1 day", $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_);
            $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_ = new \App\Services\StatisticalService();
            $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setStartAt($_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_);
            $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setEndAt($_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_);
            $data = $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->generateStatData();
            $data["record_at"] = $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_;
            $data["record_type"] = "d";
            $_obfuscated_0D39090B1C231023390E0C0D0E1A1D19031E1316155C01_ = \App\Models\Stat::where("record_at", $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_)->where("record_type", "d")->first();
            if($_obfuscated_0D39090B1C231023390E0C0D0E1A1D19031E1316155C01_) {
                $_obfuscated_0D39090B1C231023390E0C0D0E1A1D19031E1316155C01_->update($data);
                return NULL;
            }
            \App\Models\Stat::create($data);
        } catch (\Exception $ex) {
            \Log::error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage(), ["exception" => $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_]);
        }
        if(config("aikopanel.report_infomartion_daily")) {
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = "📊Thống kê hôm qua:\n\n";
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "📑Tổng số đơn hàng：" . $data["paid_count"] . " đơn\n";
            $_obfuscated_0D1B1521123B1514011A371F3735102C3933070D1A0511_ = floor($data["paid_total"] / 100);
            $_obfuscated_0D3D362E0A140C101B14110C03140E391712092A5B5B22_ = number_format($_obfuscated_0D1B1521123B1514011A371F3735102C3933070D1A0511_, 0, ".", ",");
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "💰Giá trị tổng：" . $_obfuscated_0D3D362E0A140C101B14110C03140E391712092A5B5B22_ . " VNĐ\n";
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "--------------------------------\n";
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "📑Người dùng mới：" . $data["register_count"] . " Người\n";
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "--------------------------------\n";
            $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $data["transfer_used_total"];
            $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = number_format($_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ / 1024 / 1024 / 1024, 2);
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ .= "🚦Tổng số GB: " . $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ . " Đã sử dụng";
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
        }
    }
}

?>