<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff;

class StatController extends \App\Http\Controllers\Controller
{
    public function InfoStaff(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D21321C26271831381F370209253C11153B13355B2C11_ = \App\Models\InviteCode::where("user_id", $request->user["id"])->where("status", 0)->get();
        $_obfuscated_0D2B321E14121605312F2A1C2F393E0C3C2207050E0F32_ = config("aikopanel.invite_commission", 10);
        $user = \App\Models\User::find($request->user["id"]);
        if($user->commission_rate) {
            $commission_rate = $user->commission_rate;
        }
        $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ = (int) \App\Models\Order::where("status", 3)->where("commission_status", 0)->where("invite_user_id", $request->user["id"])->sum("commission_balance");
        if(config("aikopanel.commission_distribution_enablee", 0)) {
            $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ = $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ * config("aikopanel.commission_distribution_l1") / 100;
        }
        $stat = [(int) \App\Models\User::where("invite_user_id", $request->user["id"])->count(), (int) \App\Models\CommissionLog::where("invite_user_id", $request->user["id"])->sum("get_amount"), $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_, (int) $commission_rate, (int) $user->commission_balance];
        $user = \App\Models\User::where("id", $request->user["id"])->select(["balance", "commission_balance", "discount", "commission_rate"])->first();
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        return response(["data" => ["info" => $user, "codes" => $_obfuscated_0D21321C26271831381F370209253C11153B13355B2C11_, "stat" => $stat]]);
    }
    public function getServerLastRank()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = ["shadowsocks" => \App\Models\ServerShadowsocks::where("parent_id", NULL)->get()->toArray(), "v2ray" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "trojan" => \App\Models\ServerTrojan::where("parent_id", NULL)->get()->toArray(), "vmess" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "vless" => \App\Models\ServerVless::where("parent_id", NULL)->get()->toArray(), "hysteria" => \App\Models\ServerHysteria::where("parent_id", NULL)->get()->toArray()];
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime("-1 day", strtotime(date("d-m-Y")));
        $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = \App\Models\StatServer::select(["server_id", "server_type", "u", "d", \Illuminate\Support\Facades\DB::raw("(u+d) as total")])->where("record_at", ">=", $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_)->where("record_at", "<", $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_)->where("record_type", "d")->limit(15)->orderBy("total", "DESC")->get()->toArray();
        foreach ($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_type"]] as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["id"] === $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_id"]) {
                    $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_name"] = $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"];
                }
            }
            $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] = $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] / 1073741824;
        }
        array_multisort(array_column($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_, "total"), SORT_DESC, $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_);
        return ["data" => $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_];
    }
    public function getServerTodayRank()
    {
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = ["shadowsocks" => \App\Models\ServerShadowsocks::where("parent_id", NULL)->get()->toArray(), "v2ray" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "trojan" => \App\Models\ServerTrojan::where("parent_id", NULL)->get()->toArray(), "vmess" => \App\Models\ServerVmess::where("parent_id", NULL)->get()->toArray(), "vless" => \App\Models\ServerVless::where("parent_id", NULL)->get()->toArray(), "hysteria" => \App\Models\ServerHysteria::where("parent_id", NULL)->get()->toArray()];
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = time();
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = \App\Models\StatServer::select(["server_id", "server_type", "u", "d", \Illuminate\Support\Facades\DB::raw("(u+d) as total")])->where("record_at", ">=", $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_)->where("record_at", "<", $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_)->where("record_type", "d")->limit(15)->orderBy("total", "DESC")->get()->toArray();
        foreach ($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_[$_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_type"]] as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["id"] === $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_id"]) {
                    $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_name"] = $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"];
                }
            }
            $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] = $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] / 1073741824;
        }
        array_multisort(array_column($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_, "total"), SORT_DESC, $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_);
        return ["data" => $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_];
    }
    public function getUserTodayRank(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = time();
        $_obfuscated_0D105B3C1E0C295B251508112232123B290D1E26242122_ = \App\Models\User::where("invite_user_id", $request->user["id"])->pluck("id")->toArray();
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = \App\Models\StatUser::select(["user_id", "server_rate", "u", "d", \Illuminate\Support\Facades\DB::raw("(u+d) as total")])->where("record_at", ">=", $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_)->where("record_at", "<", $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_)->where("record_type", "d")->whereIn("user_id", $_obfuscated_0D105B3C1E0C295B251508112232123B290D1E26242122_)->limit(30)->orderBy("total", "DESC")->get()->toArray();
        $data = [];
        $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_ = [];
        foreach ($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $id = $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["user_id"];
            $user = \App\Models\User::where("id", $id)->first();
            $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["email"] = $user["email"];
            $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["total"] = $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["total"] * $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_rate"] / 1073741824;
            if(isset($_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id])) {
                $_obfuscated_0D3C1A185C09323F081503101A22280D3415273E033C32_ = $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id];
                $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["total"];
                $data[$_obfuscated_0D3C1A185C09323F081503101A22280D3415273E033C32_] >>= "total";
            } else {
                unset($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["server_rate"]);
                $data[] = $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_;
                $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id] = count($data) - 1;
            }
        }
        array_multisort(array_column($data, "total"), SORT_DESC, $data);
        return ["data" => array_slice($data, 0, 15)];
    }
    public function getUserLastRank(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_ = strtotime("-1 day", strtotime(date("d-m-Y")));
        $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_ = strtotime(date("d-m-Y"));
        $_obfuscated_0D105B3C1E0C295B251508112232123B290D1E26242122_ = \App\Models\User::where("invite_user_id", $request->user["id"])->pluck("id")->toArray();
        $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ = \App\Models\StatUser::select(["user_id", "server_rate", "u", "d", \Illuminate\Support\Facades\DB::raw("(u+d) as total")])->where("record_at", ">=", $_obfuscated_0D232D3707393C040E28183135363D1832103D14161532_)->where("record_at", "<", $_obfuscated_0D24110E2E1133160E27143801280A350931260C0C1932_)->where("record_type", "d")->whereIn("user_id", $_obfuscated_0D105B3C1E0C295B251508112232123B290D1E26242122_)->limit(30)->orderBy("total", "DESC")->get()->toArray();
        $data = [];
        $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_ = [];
        foreach ($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $id = $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["user_id"];
            $user = \App\Models\User::where("id", $id)->first();
            $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["email"] = $user["email"];
            $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] = $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"] * $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_rate"] / 1073741824;
            if(isset($_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id])) {
                $_obfuscated_0D3C1A185C09323F081503101A22280D3415273E033C32_ = $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id];
                $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["total"];
                $data[$_obfuscated_0D3C1A185C09323F081503101A22280D3415273E033C32_] >>= "total";
            } else {
                unset($_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k]["server_rate"]);
                $data[] = $_obfuscated_0D40111811070B2D2B3327153E262508082B0A1E2A0D22_[$k];
                $_obfuscated_0D24211D21240E1C0B5B15013727181C320638120C1722_[$id] = count($data) - 1;
            }
        }
        array_multisort(array_column($data, "total"), SORT_DESC, $data);
        return ["data" => array_slice($data, 0, 15)];
    }
    public function getStatUser(\Illuminate\Http\Request $request)
    {
        $request->validate(["user_id" => "required|integer"]);
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\StatUser::orderBy("record_at", "DESC")->where("user_id", $request->input("user_id"));
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->count();
        $_obfuscated_0D2D2E162610305C23141D3B25102139391D2715041622_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return ["data" => $_obfuscated_0D2D2E162610305C23141D3B25102139391D2715041622_, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_];
    }
}

?>