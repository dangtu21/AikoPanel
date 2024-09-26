<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff;

class ConfigController extends \App\Http\Controllers\Controller
{
    public function setTelegramWebhook(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $id = $request->user["id"];
        $_obfuscated_0D360D23142D0237212502071B400E152A0629342A1032_ = "https://" . $request->server("HTTP_HOST");
        if(blank($_obfuscated_0D360D23142D0237212502071B400E152A0629342A1032_)) {
            return abort(500, "Vui lòng cấu hình app_url");
        }
        $_obfuscated_0D3707394028310B16083338281336160B0E0810062511_ = $_obfuscated_0D360D23142D0237212502071B400E152A0629342A1032_ . "/api/v1/guest/telegram/webhook?" . http_build_query(["access_token" => md5(config("staff.aikopanel-id-" . $id . ".telegram_bot_token", $request->input("telegram_bot_token")))]);
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService($request->input("telegram_bot_token"));
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->getMe();
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->setWebhook($_obfuscated_0D3707394028310B16083338281336160B0E0810062511_);
        return response(["data" => true]);
    }
    public function fetch(\Illuminate\Http\Request $request)
    {
        $id = $request->user["id"];
        $key = $request->input("key");
        $data = ["site" => ["app_name" => config("staff.aikopanel-id-" . $id . ".app_name", "AikoPanel"), "app_description" => config("staff.aikopanel-id-" . $id . ".app_description", "AikoPanel of AikoCute!"), "logo" => config("staff.aikopanel-id-" . $id . ".logo"), "background_url" => config("staff.aikopanel-id-" . $id . ".background_url"), "custom_html" => config("staff.aikopanel-id-" . $id . ".custom_html")], "connect" => ["telegram_bot_enable" => config("staff.aikopanel-id-" . $id . ".telegram_bot_enable", 0), "telegram_bot_token" => config("staff.aikopanel-id-" . $id . ".telegram_bot_token"), "telegram_discuss_link" => config("staff.aikopanel-id-" . $id . ".telegram_discuss_link"), "zalo_discuss_link" => config("staff.aikopanel-id-" . $id . ".zalo_discuss_link"), "report_user_traffic_today" => config("staff.aikopanel-id-" . $id . ".report_user_traffic_today", 0), "id_group_admin_report_traffic_user_today" => config("staff.aikopanel-id-" . $id . ".id_group_admin_report_traffic_user_today"), "interval_report_user_traffic_to_user_today" => config("staff.aikopanel-id-" . $id . ".interval_report_user_traffic_to_user_today"), "id_group_user_report_traffic_user_today" => config("staff.aikopanel-id-" . $id . ".id_group_user_report_traffic_user_today"), "report_node_traffic_today" => config("staff.aikopanel-id-" . $id . ".report_node_traffic_today", 0), "id_group_admin_report_traffic_node_today" => config("staff.aikopanel-id-" . $id . ".id_group_admin_report_traffic_node_today"), "interval_report_node_traffic_to_user_today" => config("staff.aikopanel-id-" . $id . ".interval_report_node_traffic_to_user_today"), "id_group_user_report_traffic_node_today" => config("staff.aikopanel-id-" . $id . ".id_group_user_report_traffic_node_today"), "report_node_online" => config("staff.aikopanel-id-" . $id . ".report_node_online", 0), "id_group_admin_report_node_online_today" => config("staff.aikopanel-id-" . $id . ".id_group_admin_report_node_online_today"), "interval_report_node_online_to_user_today" => config("staff.aikopanel-id-" . $id . ".interval_report_node_online_to_user_today"), "id_group_user_report_node_online_today" => config("staff.aikopanel-id-" . $id . ".id_group_user_report_node_online_today")]];
        if($key && isset($data[$key])) {
            return response(["data" => [$key => $data[$key]]]);
        }
        return response(["data" => $data]);
    }
    public function save(\App\Http\Requests\Staff\ConfigSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $id = $request->user["id"];
        $data = $request->validated();
        $config = config("staff.aikopanel-id-" . $id);
        foreach (\App\Http\Requests\Staff\ConfigSave::RULES as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!in_array($k, array_keys(\App\Http\Requests\Staff\ConfigSave::RULES))) {
                unset($config[$k]);
            } elseif(array_key_exists($k, $data)) {
                $config[$k] = $data[$k];
            }
        }
        $data = var_export($config, 1);
        if(!\Illuminate\Support\Facades\File::put(base_path() . "/config/staff/aikopanel-id-" . $id . ".php", "<?php\n return " . $data . " ;")) {
            abort(500, "Không chỉnh sửa");
        }
        if(function_exists("opcache_reset") && opcache_reset() === false) {
            abort(500, "Bộ nhớ cache rõ ràng, vui lòng gỡ cài đặt hoặc kiểm tra trạng thái cấu hình opcache");
        }
        \Illuminate\Support\Facades\Artisan::call("config:cache");
        return response(["data" => true]);
    }
}

?>