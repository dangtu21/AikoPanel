<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin\Server;

class ShadowsocksController extends \App\Http\Controllers\Controller
{
    protected $cloudflareService;
    public function __construct(\App\Services\CloudflareService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }
    public function save(\App\Http\Requests\Admin\ServerShadowsocksSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        if($request->input("id")) {
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerShadowsocks::find($request->input("id"));
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
        if(!\App\Models\ServerShadowsocks::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
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
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerShadowsocks::find($request->input("id"));
            if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                abort(500, "Server không tồn tại");
            }
        }
        return response(["data" => $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->delete()]);
    }
    public function update(\App\Http\Requests\Admin\ServerShadowsocksUpdate $request)
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->only(["show", "report"]);
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerShadowsocks::find($request->input("id"));
        if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            abort(500, "Server này không tồn tại");
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
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = \App\Models\ServerShadowsocks::find($request->input("id"));
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->show = 0;
        if(!$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            abort(500, "Server này không tồn tại");
        }
        if(!\App\Models\ServerShadowsocks::create($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->toArray())) {
            abort(500, "Tạo thất bại");
        }
        return response(["data" => true]);
    }
}

?>