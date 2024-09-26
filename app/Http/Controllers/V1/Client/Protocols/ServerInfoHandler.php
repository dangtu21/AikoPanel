<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Client\Protocols;

class ServerInfoHandler
{
    public function setSubscribeInfoToServers(&$servers, $user, $custom_sni)
    {
        if(!isset($servers[0])) {
            return NULL;
        }
        $_obfuscated_0D061804401A32040A3926030C0106261A191337131C22_ = (int) config("aikopanel.show_info_to_server_enable", 0);
        $_obfuscated_0D212F401A0932192B0338121B0C11323C0E313B2E2801_ = config("aikopanel.show_client_info_time_getsubscribe");
        $_obfuscated_0D393E261F35252E1E2E17232E093C101304120D332E01_ = config("aikopanel.show_client_info_expire_at");
        $_obfuscated_0D2323223415311B3B16182D103110115B3D3923112522_ = config("aikopanel.show_client_info_plan");
        $_obfuscated_0D3D35151025312909122B222E0837095B1F2D07280C01_ = config("aikopanel.show_client_info_used_traffic");
        $_obfuscated_0D17342A2B152D3919080D2A0A111803273023193F3F22_ = config("aikopanel.show_client_info_sni");
        if(!$_obfuscated_0D061804401A32040A3926030C0106261A191337131C22_) {
            return NULL;
        }
        $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ = round($user["u"] / 1048576, 2);
        $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_ = round($user["d"] / 1048576, 2);
        $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ = $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ + $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_;
        $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ = round($user["transfer_enable"] / 1048576, 2);
        if(1024 < $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_) {
            $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ = round($_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ / 1024, 2) . " GB";
        } else {
            $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ .= " MB";
        }
        if(1024 < $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_) {
            $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ = round($_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ / 1024, 2) . " GB";
        } else {
            $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ .= " MB";
        }
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $_obfuscated_0D39152A250D3908061F39261E0C2C271B0624160A1211_ = date("d-m-Y | H:i:s");
        $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_ = $user["expired_at"] ? date("d-m-Y", $user["expired_at"]) : "Vĩnh Viễn";
        $_obfuscated_0D043923111B31140A212B182A060230195B3B162D2C01_ = \App\Models\Plan::find($user->plan_id);
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = $_obfuscated_0D043923111B31140A212B182A060230195B3B162D2C01_ ? $_obfuscated_0D043923111B31140A212B182A060230195B3B162D2C01_->name : "Không xác định";
        if($_obfuscated_0D17342A2B152D3919080D2A0A111803273023193F3F22_) {
            $_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_ = $custom_sni ?? $user->sni ?? "Mặc định";
            $_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_ = base_path() . "/resources/rules/custom.sni.json";
            $_obfuscated_0D35370C3D1608363E363518262B3908081416283B4022_ = base_path() . "/resources/rules/default.sni.json";
            if(file_exists($_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_)) {
                $_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_ = file_get_contents($_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_);
                $_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ = json_decode($_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_, true);
            } else {
                $_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_ = file_get_contents($_obfuscated_0D35370C3D1608363E363518262B3908081416283B4022_);
                $_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ = json_decode($_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_, true);
            }
            if($_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_) {
                foreach ($_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ as $sni) {
                    if($sni["abbreviation"] === $_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_ || $sni["value"] === $_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_) {
                        $_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_ = $sni["lable"];
                    }
                }
            }
            array_unshift($servers, array_merge($servers[0], ["name" => "🔰 SNI: " . $_obfuscated_0D37220B3D1E373D313F1603041510172B3E1213081322_]));
        }
        if($_obfuscated_0D212F401A0932192B0338121B0C11323C0E313B2E2801_) {
            array_unshift($servers, array_merge($servers[0], ["name" => "📅 " . $_obfuscated_0D39152A250D3908061F39261E0C2C271B0624160A1211_ . " ⏲"]));
        }
        if($_obfuscated_0D393E261F35252E1E2E17232E093C101304120D332E01_) {
            array_unshift($servers, array_merge($servers[0], ["name" => "🔰 HSD: " . $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_]));
        }
        if($_obfuscated_0D2323223415311B3B16182D103110115B3D3923112522_) {
            array_unshift($servers, array_merge($servers[0], ["name" => "📝 Gói: " . $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_]));
        }
        if($_obfuscated_0D3D35151025312909122B222E0837095B1F2D07280C01_) {
            array_unshift($servers, array_merge($servers[0], ["name" => "Dùng: " . $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ . " / " . $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_]));
        }
        if(empty($user->username)) {
            array_unshift($servers, array_merge($servers[0], ["name" => "🔰 ID: " . $user->id]));
        } else {
            array_unshift($servers, array_merge($servers[0], ["name" => "🔰 ID: " . $user->id . " | " . $user->username]));
        }
    }
}

?>