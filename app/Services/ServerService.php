<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class ServerService
{
    public function getAvailableVless($user)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = [];
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\ServerVless::orderBy("sort", "ASC");
        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get();
        foreach ($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ as $key => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["show"]) {
            } else {
                $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["type"] = "vless";
                if(!in_array($user->group_id, $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["group_id"])) {
                } else {
                    if(strpos($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["port"], "-") !== false) {
                        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["port"] = \App\Utils\Helper::randomPort($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["port"]);
                    }
                    if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["parent_id"]) {
                        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_VLESS_LAST_CHECK_AT", $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["parent_id"]));
                    } else {
                        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_VLESS_LAST_CHECK_AT", $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["id"]));
                    }
                    if(isset($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["tls_settings"]) && isset($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["tls_settings"]["private_key"])) {
                        $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["tls_settings"] = array_diff_key($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]["tls_settings"], ["private_key" => ""]);
                    }
                    $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[] = $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_[$key]->toArray();
                }
            }
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAvailableVmess($user)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = [];
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\ServerVmess::orderBy("sort", "ASC");
        $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get();
        foreach ($_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_ as $key => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["show"]) {
            } else {
                $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["type"] = "vmess";
                if(!in_array($user->group_id, $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["group_id"])) {
                } else {
                    if(strpos($_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["port"], "-") !== false) {
                        $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["port"] = \App\Utils\Helper::randomPort($_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["port"]);
                    }
                    if($_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["parent_id"]) {
                        $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_VMESS_LAST_CHECK_AT", $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["parent_id"]));
                    } else {
                        $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_VMESS_LAST_CHECK_AT", $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]["id"]));
                    }
                    $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[] = $_obfuscated_0D163C5B3F073E1D1F0C383D343901191D2A2A1C3E5C22_[$key]->toArray();
                }
            }
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAvailableTrojan($user)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = [];
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\ServerTrojan::orderBy("sort", "ASC");
        $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get();
        foreach ($_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_ as $key => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["show"]) {
            } else {
                $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["type"] = "trojan";
                if(!in_array($user->group_id, $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["group_id"])) {
                } else {
                    if(strpos($_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["port"], "-") !== false) {
                        $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["port"] = \App\Utils\Helper::randomPort($_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["port"]);
                    }
                    if($_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["parent_id"]) {
                        $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_TROJAN_LAST_CHECK_AT", $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["parent_id"]));
                    } else {
                        $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_TROJAN_LAST_CHECK_AT", $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]["id"]));
                    }
                    $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[] = $_obfuscated_0D2A182F11380D041D1C362F31332D1A30333F3C3C5B11_[$key]->toArray();
                }
            }
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAvailableHysteria(\App\Models\User $user)
    {
        $_obfuscated_0D035C2616012D342803233B1D093C032A2F1D112F1E11_ = [];
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\ServerHysteria::orderBy("sort", "ASC");
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get()->keyBy("id");
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $key => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["show"]) {
            } else {
                $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["type"] = "hysteria";
                $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_HYSTERIA_LAST_CHECK_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"]));
                if(!in_array($user->group_id, $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["group_id"])) {
                } else {
                    if(strpos($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["port"], "-") !== false) {
                        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["port"] = \App\Utils\Helper::randomPort($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["port"]);
                    }
                    if(isset($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]])) {
                        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_HYSTERIA_LAST_CHECK_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]));
                        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["created_at"] = $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]]["created_at"];
                    }
                    $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["server_key"] = \App\Utils\Helper::getServerKey($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]["created_at"], 16);
                    $_obfuscated_0D035C2616012D342803233B1D093C032A2F1D112F1E11_[] = $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$key]->toArray();
                }
            }
        }
        return $_obfuscated_0D035C2616012D342803233B1D093C032A2F1D112F1E11_;
    }
    public function getAvailableShadowsocks(\App\Models\User $user)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = [];
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\ServerShadowsocks::orderBy("sort", "ASC");
        $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get()->keyBy("id");
        foreach ($_obfuscated_0D052D0608062F340A30111927192229050A130D313332_ as $key => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["show"]) {
            } else {
                $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]["type"] = "shadowsocks";
                $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_SHADOWSOCKS_LAST_CHECK_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"]));
                if(!in_array($user->group_id, $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["group_id"])) {
                } else {
                    if(strpos($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["port"], "-") !== false) {
                        $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]["port"] = \App\Utils\Helper::randomPort($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["port"]);
                    }
                    if(isset($_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]])) {
                        $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_SHADOWSOCKS_LAST_CHECK_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]));
                        $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]["created_at"] = $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"]]["created_at"];
                    }
                    $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[] = $_obfuscated_0D052D0608062F340A30111927192229050A130D313332_[$key]->toArray();
                }
            }
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAvailableServers(\App\Models\User $user)
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = array_merge($this->getAvailableShadowsocks($user), $this->getAvailableVmess($user), $this->getAvailableTrojan($user), $this->getAvailableHysteria($user), $this->getAvailableVless($user));
        $this->mergeData($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
        $_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_ = array_column($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, "sort");
        array_multisort($_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_, SORT_ASC, $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
        return array_map(function ($server) {
            $server["port"] = (int) $server["port"];
            $server["is_online"] = $server["last_check_at"] < time() - 300 ? 0 : 1;
            $server["cache_key"] = $server["type"] . "-" . $server["id"] . "-" . $server["updated_at"] . "-" . $server["is_online"];
            return $server;
        }, $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_);
    }
    public function getAvailableUsers($groupId)
    {
        return \App\Models\User::whereIn("group_id", $groupId)->whereRaw("u + d < transfer_enable")->where(function ($query) {
            $query->where("expired_at", ">=", time())->orWhere("expired_at", NULL);
        })->where("banned", 0)->select(["id", "uuid", "speed_limit", "device_limit"])->get();
    }
    public function log(int $userId, int $serverId, int $u, int $d, $rate, $method)
    {
        if($u + $d < 10240) {
            return true;
        }
        $_obfuscated_0D311F302232305B072A1E362C0106291113052A252A01_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_ = \App\Models\ServerLog::where("log_at", ">=", $_obfuscated_0D311F302232305B072A1E362C0106291113052A252A01_)->where("log_at", "<", $_obfuscated_0D311F302232305B072A1E362C0106291113052A252A01_ + 3600)->where("server_id", $serverId)->where("user_id", $userId)->where("rate", $rate)->where("method", $method)->first();
        if($_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_) {
            try {
                $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->increment("u", $u);
                $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->increment("d", $d);
                return true;
            } catch (\Exception $ex) {
                return false;
            }
        } else {
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_ = new \App\Models\ServerLog();
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->user_id = $userId;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->server_id = $serverId;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->u = $u;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->d = $d;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->rate = $rate;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->log_at = $_obfuscated_0D311F302232305B072A1E362C0106291113052A252A01_;
            $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->method = $method;
            return $_obfuscated_0D3340053C280D400E3E5C105B321B21102D372F321F22_->save();
        }
    }
    public function getAllShadowsocks()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = \App\Models\ServerShadowsocks::orderBy("sort", "ASC")->get()->toArray();
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$k]["type"] = "shadowsocks";
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAllVMess()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = \App\Models\ServerVmess::orderBy("sort", "ASC")->get()->toArray();
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$k]["type"] = "vmess";
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAllVLess()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = \App\Models\ServerVless::orderBy("sort", "ASC")->get()->toArray();
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$k]["type"] = "vless";
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAllTrojan()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = \App\Models\ServerTrojan::orderBy("sort", "ASC")->get()->toArray();
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$k]["type"] = "trojan";
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    public function getAllHysteria()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = \App\Models\ServerHysteria::orderBy("sort", "ASC")->get()->toArray();
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$k]["type"] = "hysteria";
        }
        return $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_;
    }
    private function mergeData(&$servers)
    {
        foreach ($servers as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ = strtoupper($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["type"]);
            $servers[$k]["online"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_ONLINE_USER", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"] ?? $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"]));
            $servers[$k]["last_check_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_LAST_CHECK_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"] ?? $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"]));
            $servers[$k]["last_push_at"] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_LAST_PUSH_AT", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["parent_id"] ?? $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"]));
            if(isset($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["ips"])) {
                if(is_string($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["ips"])) {
                    $_obfuscated_0D1F111B5B3B2D23091931020502350A2105280A2A3732_ = explode(",", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["ips"]);
                } elseif(is_array($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["ips"])) {
                    $_obfuscated_0D1F111B5B3B2D23091931020502350A2105280A2A3732_ = $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["ips"];
                } else {
                    $_obfuscated_0D1F111B5B3B2D23091931020502350A2105280A2A3732_ = [];
                }
                $servers[$k]["online_ip"] = [];
                $servers[$k]["status_ip"] = [];
                foreach ($_obfuscated_0D1F111B5B3B2D23091931020502350A2105280A2A3732_ as $ip) {
                    $ip = trim($ip);
                    $servers[$k]["online_ip"][$ip] = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_ONLINE_IP", $ip), 0);
                    $_obfuscated_0D3E3F0429313012243B2B18224011142B181502062711_ = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_LAST_CHECK_AT", $ip));
                    $_obfuscated_0D3D0F35211C22241D31105B38132A5C092F0E172F0C22_ = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SERVER_" . $_obfuscated_0D0C0D1422050716170D05322C1937331A0C1B183B1C11_ . "_LAST_CHECK_AT", $ip));
                    if($_obfuscated_0D3E3F0429313012243B2B18224011142B181502062711_ <= time() - 300) {
                        $servers[$k]["status_ip"][$ip] = 0;
                    } elseif($_obfuscated_0D3D0F35211C22241D31105B38132A5C092F0E172F0C22_ <= time() - 300) {
                        $servers[$k]["status_ip"][$ip] = 1;
                    } else {
                        $servers[$k]["status_ip"][$ip] = 2;
                    }
                }
            } else {
                $servers[$k]["online_ip"] = NULL;
                $servers[$k]["status_ip"] = NULL;
            }
            if($servers[$k]["last_check_at"] <= time() - 300) {
                $servers[$k]["available_status"] = 0;
            } elseif($servers[$k]["last_push_at"] <= time() - 300) {
                $servers[$k]["available_status"] = 1;
            } else {
                $servers[$k]["available_status"] = 2;
            }
        }
    }
    public function getAllServers()
    {
        $servers = array_merge($this->getAllShadowsocks(), $this->getAllVMess(), $this->getAllTrojan(), $this->getAllHysteria(), $this->getAllVLess());
        $this->mergeData($servers);
        $_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_ = array_column($servers, "sort");
        array_multisort($_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_, SORT_ASC, $servers);
        return $servers;
    }
    public function getRoutes(array $routeIds)
    {
        $_obfuscated_0D302403173E1801152A30012622364004283023350E32_ = \App\Models\ServerRoute::select(["id", "match", "action", "action_value"])->whereIn("id", $routeIds)->get();
        foreach ($_obfuscated_0D302403173E1801152A30012622364004283023350E32_ as $k => $_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_) {
            $array = json_decode($_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_->match, true);
            if(is_array($array)) {
                $_obfuscated_0D302403173E1801152A30012622364004283023350E32_[$k]["match"] = $array;
            }
        }
        return $_obfuscated_0D302403173E1801152A30012622364004283023350E32_;
    }
    public function getServer($serverId, $serverType)
    {
        switch ($serverType) {
            case "vmess":
                return \App\Models\ServerVmess::find($serverId);
                break;
            case "shadowsocks":
                return \App\Models\ServerShadowsocks::find($serverId);
                break;
            case "trojan":
                return \App\Models\ServerTrojan::find($serverId);
                break;
            case "hysteria":
                return \App\Models\ServerHysteria::find($serverId);
                break;
            case "vless":
                return \App\Models\ServerVless::find($serverId);
                break;
            default:
                return false;
        }
    }
}

?>