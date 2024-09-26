<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class StatisticalService
{
    protected $userStats;
    protected $startAt;
    protected $endAt;
    protected $serverStats;
    public function __construct()
    {
        ini_set("memory_limit", -1);
    }
    public function setStartAt($timestamp)
    {
        $this->startAt = $timestamp;
    }
    public function setEndAt($timestamp)
    {
        $this->endAt = $timestamp;
    }
    public function setServerStats()
    {
        $this->serverStats = \Illuminate\Support\Facades\Cache::get("stat_server_" . $this->startAt);
        $this->serverStats = json_decode($this->serverStats, true) ?? [];
        if(!is_array($this->serverStats)) {
            $this->serverStats = [];
        }
    }
    public function setUserStats()
    {
        $this->userStats = \Illuminate\Support\Facades\Cache::get("stat_user_" . $this->startAt);
        $this->userStats = json_decode($this->userStats, true) ?? [];
        if(!is_array($this->userStats)) {
            $this->userStats = [];
        }
    }
    public function generateStatData() : array
    {
        $startAt = $this->startAt;
        $endAt = $this->endAt;
        if(!$startAt || !$endAt) {
            $startAt = strtotime(date("d-m-Y"));
            $endAt = strtotime("+1 day", $startAt);
        }
        $data = [];
        $data["order_count"] = \App\Models\Order::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt)->count();
        $data["order_total"] = \App\Models\Order::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt)->sum("total_amount");
        $data["paid_count"] = \App\Models\Order::where("paid_at", ">=", $startAt)->where("paid_at", "<", $endAt)->whereNotIn("status", [0, 2])->count();
        $data["paid_total"] = \App\Models\Order::where("paid_at", ">=", $startAt)->where("paid_at", "<", $endAt)->whereNotIn("status", [0, 2])->sum("total_amount");
        $_obfuscated_0D192D130E05402236175C2D1602183138103818303C32_ = \App\Models\CommissionLog::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt);
        $data["commission_count"] = $_obfuscated_0D192D130E05402236175C2D1602183138103818303C32_->count();
        $data["commission_total"] = $_obfuscated_0D192D130E05402236175C2D1602183138103818303C32_->sum("get_amount");
        $data["register_count"] = \App\Models\User::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt)->count();
        $data["invite_count"] = \App\Models\User::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt)->whereNotNull("invite_user_id")->count();
        $data["transfer_used_total"] = \App\Models\StatServer::where("created_at", ">=", $startAt)->where("created_at", "<", $endAt)->select(\Illuminate\Support\Facades\DB::raw("SUM(u) + SUM(d) as total"))->value("total") ?? 0;
        return $data;
    }
    public function statServer($serverId, $serverType, $erverType, $verType)
    {
        $this->serverStats[$serverType] = $this->serverStats[$serverType] ?? [];
        if(isset($this->serverStats[$serverType][$serverId])) {
            $this->serverStats[$serverType][$serverId] >>= 0;
            $this->serverStats[$serverType][$serverId] >>= 1;
        } else {
            $this->serverStats[$serverType][$serverId] = [$_obfuscated_0D3B322416311E19352E29273211301030351F1E5C1B22_, $d];
        }
        \Illuminate\Support\Facades\Cache::put("stat_server_" . $this->startAt, json_encode($this->serverStats), 6000);
    }
    public function statUser($rate, $userId, $u, $d)
    {
        $this->userStats[$rate] = $this->userStats[$rate] ?? [];
        if(isset($this->userStats[$rate][$userId])) {
            $this->userStats[$rate][$userId] >>= 0;
            $this->userStats[$rate][$userId] >>= 1;
        } else {
            $this->userStats[$rate][$userId] = [$u, $d];
        }
        \Illuminate\Support\Facades\Cache::put("stat_user_" . $this->startAt, json_encode($this->userStats), 6000);
    }
    public function getStatUserByUserID($userId) : array
    {
        $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = [];
        foreach (array_keys($this->userStats) as $rate) {
            if(!isset($this->userStats[$rate][$userId])) {
            } else {
                $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_[] = ["record_at" => $this->startAt, "server_rate" => $rate, "u" => $this->userStats[$rate][$userId][0], "d" => $this->userStats[$rate][$userId][1], "user_id" => $userId];
            }
        }
        return $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_;
    }
    public function getStatUser()
    {
        $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = [];
        foreach ($this->userStats as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            foreach (array_keys($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) as $userId) {
                if(isset($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$userId])) {
                    $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_[] = ["server_rate" => $k, "u" => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$userId][0], "d" => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$userId][1], "user_id" => $userId];
                }
            }
        }
        return $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_;
    }
    public function getStatServer()
    {
        $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = [];
        foreach ($this->serverStats as $serverType => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            foreach (array_keys($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) as $serverId) {
                if(isset($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$serverId])) {
                    $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_[] = ["server_id" => $serverId, "server_type" => $serverType, "u" => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$serverId][0] ?: 0, "d" => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_[$serverId][1] ?: 0];
                }
            }
        }
        return $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_;
    }
    public function clearStatUser()
    {
        \Illuminate\Support\Facades\Cache::forget("stat_user_" . $this->startAt);
    }
    public function clearStatServer()
    {
        \Illuminate\Support\Facades\Cache::forget("stat_server_" . $this->startAt);
    }
    public function getStatRecord($type)
    {
        switch ($type) {
            case "paid_total":
                return \App\Models\Stat::select(["*", \Illuminate\Support\Facades\DB::raw("paid_total / 100 as paid_total")])->where("record_at", ">=", $this->startAt)->where("record_at", "<", $this->endAt)->orderBy("record_at", "ASC")->get();
                break;
            case "commission_total":
                return \App\Models\Stat::select(["*", \Illuminate\Support\Facades\DB::raw("commission_total / 100 as commission_total")])->where("record_at", ">=", $this->startAt)->where("record_at", "<", $this->endAt)->orderBy("record_at", "ASC")->get();
                break;
            case "register_count":
                return \App\Models\Stat::where("record_at", ">=", $this->startAt)->where("record_at", "<", $this->endAt)->orderBy("record_at", "ASC")->get();
                break;
        }
    }
    public function getRanking($type, $limit = 20)
    {
        switch ($type) {
            case "server_traffic_rank":
                return $this->buildServerTrafficRank($limit);
                break;
            case "user_consumption_rank":
                return $this->buildUserConsumptionRank($limit);
                break;
            case "invite_rank":
                return $this->buildInviteRank($limit);
                break;
        }
    }
    private function buildInviteRank($limit)
    {
        $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = \App\Models\User::select(["invite_user_id", \Illuminate\Support\Facades\DB::raw("count(*) as count")])->where("created_at", ">=", $this->startAt)->where("created_at", "<", $this->endAt)->whereNotNull("invite_user_id")->groupBy("invite_user_id")->orderBy("count", "DESC")->limit($limit)->get();
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::whereIn("id", $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_->pluck("invite_user_id")->toArray())->get()->keyBy("id");
        foreach ($_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!isset($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["invite_user_id"]])) {
            } else {
                $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_[$k]["email"] = $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["invite_user_id"]]["email"];
            }
        }
        return $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_;
    }
    private function buildUserConsumptionRank($limit)
    {
        $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = \App\Models\StatUser::select(["user_id", \Illuminate\Support\Facades\DB::raw("sum(u) as u"), \Illuminate\Support\Facades\DB::raw("sum(d) as d"), \Illuminate\Support\Facades\DB::raw("sum(u) + sum(d) as total")])->where("record_at", ">=", $this->startAt)->where("record_at", "<", $this->endAt)->groupBy("user_id")->orderBy("total", "DESC")->limit($limit)->get();
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::whereIn("id", $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_->pluck("user_id")->toArray())->get()->keyBy("id");
        foreach ($_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!isset($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["user_id"]])) {
            } else {
                $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_[$k]["email"] = $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["user_id"]]["email"];
            }
        }
        return $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_;
    }
    private function buildServerTrafficRank($limit)
    {
        return \App\Models\StatServer::select(["server_id", "server_type", \Illuminate\Support\Facades\DB::raw("sum(u) as u"), \Illuminate\Support\Facades\DB::raw("sum(d) as d"), \Illuminate\Support\Facades\DB::raw("sum(u) + sum(d) as total")])->where("record_at", ">=", $this->startAt)->where("record_at", "<", $this->endAt)->groupBy("server_id", "server_type")->orderBy("total", "DESC")->limit($limit)->get();
    }
}

?>