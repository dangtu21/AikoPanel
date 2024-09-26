<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V3\Aiko;

class AikoController extends \App\Http\Controllers\Controller
{
    private $nodeType;
    private $nodeInfo;
    private $nodeId;
    private $serverService;
    public function __construct(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $token = $request->input("token");
        if(empty($token)) {
            abort(500, "token is null");
        }
        if($token !== config("aikopanel.server_token")) {
            abort(500, "token is error");
        }
        $this->nodeType = $request->input("node_type");
        if($this->nodeType === "v2ray") {
            $this->nodeType = "vmess";
        }
        if($this->nodeType === "hysteria2") {
            $this->nodeType = "hysteria";
        }
        $this->nodeId = $request->input("node_id");
        $this->serverService = new \App\Services\ServerService();
        $this->nodeInfo = $this->serverService->getServer($this->nodeId, $this->nodeType);
        if(!$this->nodeInfo) {
            abort(500, "server is not exist");
        }
    }
    public function user(\Illuminate\Http\Request $request)
    {
        ini_set("memory_limit", -1);
        $_obfuscated_0D0C1A1D081137182419252A061A5C0B163C5B192C3E11_ = $request->ip();
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_LAST_CHECK_AT", $_obfuscated_0D0C1A1D081137182419252A061A5C0B163C5B192C3E11_), time(), 3600);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_LAST_CHECK_AT", $this->nodeInfo->id), time(), 3600);
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = $this->serverService->getAvailableUsers($this->nodeInfo->group_id);
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_->toArray();
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = array_map(function ($user) {
            if($user["device_limit"] == NULL || $user["device_limit"] <= 0) {
                return $user;
            }
            $ips_array = \Illuminate\Support\Facades\Cache::get("ALIVE_IP_USER_" . $user["id"]);
            $count = 0;
            if($ips_array) {
                $count = $ips_array["alive_ip"];
            }
            $user["alive_ip"] = $count;
            return $user;
        }, $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_);
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_["users"] = $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_;
        $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ = sha1(json_encode($_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_));
        if(strpos($request->header("If-None-Match"), $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_) !== false) {
            abort(304);
        }
        return response($response)->header("ETag", "\"" . $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ . "\"");
    }
    public function push(\Illuminate\Http\Request $request)
    {
        $data = request()->getContent() ?: json_encode($_POST);
        $data = json_decode($data, true);
        if($data === NULL && json_last_error() !== JSON_ERROR_NONE) {
            return response(["error" => "Invalid traffic data"], 400);
        }
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_ONLINE_USER", $this->nodeInfo->id), count($data), 3600);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_LAST_PUSH_AT", $this->nodeInfo->id), time(), 3600);
        $_obfuscated_0D0C1A1D081137182419252A061A5C0B163C5B192C3E11_ = $request->ip();
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_ONLINE_IP", $_obfuscated_0D0C1A1D081137182419252A061A5C0B163C5B192C3E11_), count($data), 3600);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SERVER_" . strtoupper($this->nodeType) . "_LAST_PUSH_AT", $_obfuscated_0D0C1A1D081137182419252A061A5C0B163C5B192C3E11_), time(), 3600);
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->trafficFetch($this->nodeInfo->toArray(), $this->nodeType, $data);
        return response(["data" => true]);
    }
    public function alive(\Illuminate\Http\Request $request)
    {
        $data = request()->getContent() ?: json_encode($_POST);
        $data = json_decode($data, true);
        if($data === NULL && json_last_error() !== JSON_ERROR_NONE) {
            return response(["error" => "Invalid online data"], 400);
        }
        foreach ($data as $_obfuscated_0D113409130418292F074024382A030F2F16141D0F0A32_ => $_obfuscated_0D050A3422061D5C351A25092A222F18041C2A25022422_) {
            $_obfuscated_0D3D152B1C2A313727320F39242617031508121F3D3F22_ = time();
            $_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_ = \Illuminate\Support\Facades\Cache::get("ALIVE_IP_USER_" . $_obfuscated_0D113409130418292F074024382A030F2F16141D0F0A32_) ?? [];
            foreach ($_obfuscated_0D050A3422061D5C351A25092A222F18041C2A25022422_ as $ip) {
                $_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_["aliveips"][$ip]["lastupdateAt"] = $_obfuscated_0D3D152B1C2A313727320F39242617031508121F3D3F22_;
            }
            $_obfuscated_0D27240A093F1F1A1A2F021C5B2714081432031B121132_ = config("aikopanel.server_alive_interval", 120);
            foreach ($_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_["aliveips"] as $ip => $info) {
                if($_obfuscated_0D27240A093F1F1A1A2F021C5B2714081432031B121132_ < $_obfuscated_0D3D152B1C2A313727320F39242617031508121F3D3F22_ - $info["lastupdateAt"]) {
                    unset($_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_["aliveips"][$ip]);
                }
            }
            $_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_["alive_ip"] = count($_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_["aliveips"]);
            \Illuminate\Support\Facades\Cache::put("ALIVE_IP_USER_" . $_obfuscated_0D113409130418292F074024382A030F2F16141D0F0A32_, $_obfuscated_0D5B0626252C2704052635241E5B02323C0A3505265B01_, $_obfuscated_0D27240A093F1F1A1A2F021C5B2714081432031B121132_);
        }
        return response(["data" => true]);
    }
    public function config(\Illuminate\Http\Request $request)
    {
        switch ($this->nodeType) {
            case "shadowsocks":
                $response = ["server_port" => $this->nodeInfo->server_port, "cipher" => $this->nodeInfo->cipher, "obfs" => $this->nodeInfo->obfs, "obfs_settings" => $this->nodeInfo->obfs_settings, "speed_limit" => $this->nodeInfo->speed_limit];
                if($this->nodeInfo->cipher === "2022-blake3-aes-128-gcm") {
                    $response["server_key"] = \App\Utils\Helper::getServerKey($this->nodeInfo->created_at, 16);
                }
                if($this->nodeInfo->cipher === "2022-blake3-aes-256-gcm") {
                    $response["server_key"] = \App\Utils\Helper::getServerKey($this->nodeInfo->created_at, 32);
                }
                break;
            case "vmess":
                $response = ["server_port" => $this->nodeInfo->server_port, "network" => $this->nodeInfo->network, "networkSettings" => $this->nodeInfo->networkSettings, "tls" => $this->nodeInfo->tls, "speed_limit" => $this->nodeInfo->speed_limit];
                break;
            case "vless":
                $response = ["server_port" => $this->nodeInfo->server_port, "network" => $this->nodeInfo->network, "networkSettings" => $this->nodeInfo->network_settings, "tls" => $this->nodeInfo->tls, "flow" => $this->nodeInfo->flow, "tls_settings" => $this->nodeInfo->tls_settings, "speed_limit" => $this->nodeInfo->speed_limit];
                break;
            case "trojan":
                $response = ["host" => $this->nodeInfo->host, "network" => $this->nodeInfo->network, "networkSettings" => $this->nodeInfo->network_settings, "server_port" => $this->nodeInfo->server_port, "server_name" => $this->nodeInfo->server_name, "speed_limit" => $this->nodeInfo->speed_limit];
                break;
            case "hysteria":
                $response = ["version" => $this->nodeInfo->version, "host" => $this->nodeInfo->host, "server_port" => $this->nodeInfo->server_port, "server_name" => $this->nodeInfo->server_name, "up_mbps" => $this->nodeInfo->up_mbps, "down_mbps" => $this->nodeInfo->down_mbps, "speed_limit" => $this->nodeInfo->speed_limit];
                if($this->nodeInfo->version == 1) {
                    $response["obfs"] = $this->nodeInfo->obfs_password ?? NULL;
                } elseif($this->nodeInfo->version == 2) {
                    $response["ignore_client_bandwidth"] = true;
                    $response["obfs"] = $this->nodeInfo->obfs ?? NULL;
                    $response["obfs-password"] = $this->nodeInfo->obfs_password ?? NULL;
                }
                break;
            default:
                $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ = parse_url(config("aikopanel.app_url"))["host"] ?? "aikopanel.com";
                $license = \Illuminate\Support\Facades\Cache::get("license_" . $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_);
                if($license === NULL) {
                    abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
                }
                $_obfuscated_0D331F370C251207140A2E133F1F5B0D402E280E152711_ = \Illuminate\Support\Facades\Cache::get("report_key_" . $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_) ? true : false;
                $response["base_config"] = ["push_interval" => (int) config("aikopanel.server_push_interval", 60), "pull_interval" => (int) config("aikopanel.server_pull_interval", 60)];
                $response["license"] = $license;
                $response["license_status"] = $_obfuscated_0D331F370C251207140A2E133F1F5B0D402E280E152711_;
                if($this->nodeInfo["route_id"]) {
                    $response["routes"] = $this->serverService->getRoutes($this->nodeInfo["route_id"]);
                }
                $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ = sha1(json_encode($response));
                if(strpos($request->header("If-None-Match"), $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_) !== false) {
                    abort(304);
                }
                return response($response)->header("ETag", "\"" . $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ . "\"");
        }
    }
}

?>