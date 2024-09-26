<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin\Server;

class VlessController extends \App\Http\Controllers\Controller
{
    protected $cloudflareService;
    public function __construct(\App\Services\CloudflareService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }
    public function save(\App\Http\Requests\Admin\ServerVlessSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls"]) && (int) $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls"] === 2) {
            $_obfuscated_0D2C2E032223022A12381A251726153C3F360B0C0A0D22_ = \ParagonIE_Sodium_Compat::crypto_box_keypair();
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"] = $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"] ?? [];
            if(!isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["public_key"])) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["public_key"] = \App\Utils\Helper::base64EncodeUrlSafe(\ParagonIE_Sodium_Compat::crypto_box_publickey($_obfuscated_0D2C2E032223022A12381A251726153C3F360B0C0A0D22_));
            }
            if(!isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["private_key"])) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["private_key"] = \App\Utils\Helper::base64EncodeUrlSafe(\ParagonIE_Sodium_Compat::crypto_box_secretkey($_obfuscated_0D2C2E032223022A12381A251726153C3F360B0C0A0D22_));
            }
            if(!isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["short_id"])) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["short_id"] = substr(sha1($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["private_key"]), 0, 8);
            }
            if(!isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["server_port"])) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["tls_settings"]["server_port"] = "443";
            }
        }
        if($request->input("id")) {
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerVless::find($request->input("id"));
            if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                abort(500, "Server không tồn tại");
            }
            try {
                $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
                if(!empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["host"]) && !empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ip"]) && config("aikopanel.cloudflare_email") && config("aikopanel.cloudflare_api_key") && config("aikopanel.cloudflare_zone_id") && empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ips"])) {
                    $this->cloudflareService->updateDnsRecord($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["host"], "A", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ip"]);
                }
            } catch (\Exception $ex) {
                abort(500, "Lưu thất bại");
            }
            return response(["data" => true]);
        }
        if(!\App\Models\ServerVless::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
            abort(500, "Tạo thất bại");
        }
        if(!empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["host"]) && !empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ip"]) && config("aikopanel.cloudflare_email") && config("aikopanel.cloudflare_api_key") && config("aikopanel.cloudflare_zone_id") && empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ips"])) {
            $this->cloudflareService->updateDnsRecord($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["host"], "A", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["ip"]);
        }
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if($request->input("id")) {
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerVless::find($request->input("id"));
            if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                abort(500, "ID của nút không tồn tại.");
            }
        }
        return response(["data" => $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->delete()]);
    }
    public function update(\App\Http\Requests\Admin\ServerVlessUpdate $request)
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->only(["show", "report"]);
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerVless::find($request->input("id"));
        if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            abort(500, "Server này không tồn tại.");
        }
        try {
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        } catch (\Exception $ex) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function copy(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerVless::find($request->input("id"));
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->show = 0;
        if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            abort(500, "Server không tồn tại");
        }
        if(!\App\Models\ServerVless::create($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->toArray())) {
            abort(500, "Sao chép thất bại");
        }
        return response(["data" => true]);
    }
}

?>