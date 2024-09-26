<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin\Server;

class ManageController extends \App\Http\Controllers\Controller
{
    public function getNodes(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_ = new \App\Services\ServerService();
        return response(["data" => $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_->getAllServers()]);
    }
    public function sort(\Illuminate\Http\Request $request)
    {
        ini_set("post_max_size", "5m");
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->only("shadowsocks", "vmess", "vless", "trojan", "hysteria") ?? [];
        if(empty($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = ["shadowsocks" => $_POST["shadowsocks"] ?? NULL, "vmess" => $_POST["vmess"] ?? NULL, "vless" => $_POST["vless"] ?? NULL, "trojan" => $_POST["trojan"] ?? NULL, "hysteria" => $_POST["hysteria"] ?? NULL];
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        foreach ($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = "App\\Models\\Server" . ucfirst($k);
            foreach ($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_ as $id => $sort) {
                if(!$_obfuscated_0D322C372829302D26163D2E2932110322153407022822_::find($id)->update(["sort" => $sort])) {
                    \Illuminate\Support\Facades\DB::rollBack();
                    abort(500, "Lưu thất bại");
                }
            }
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => true]);
    }
}

?>