<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class InviteController extends \App\Http\Controllers\Controller
{
    public function save(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(config("aikopanel.invite_gen_limit", 5) <= \App\Models\InviteCode::where("user_id", $request->user["id"])->where("status", 0)->count()) {
            abort(500, __("The maximum number of creations has been reached"));
        }
        $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_ = new \App\Models\InviteCode();
        $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->user_id = $request->user["id"];
        $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->code = \App\Utils\Helper::randomChar(8);
        return response(["data" => $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->save()]);
    }
    public function details(\Illuminate\Http\Request $request)
    {
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("page_size") ? $request->input("page_size") : 10;
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\CommissionLog::where("invite_user_id", $request->user["id"])->where("get_amount", ">", 0)->select(["id", "trade_no", "order_amount", "get_amount", "created_at"])->orderBy("created_at", "DESC");
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->count();
        $details = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return response(["data" => $details, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D21321C26271831381F370209253C11153B13355B2C11_ = \App\Models\InviteCode::where("user_id", $request->user["id"])->where("status", 0)->get();
        $_obfuscated_0D2B321E14121605312F2A1C2F393E0C3C2207050E0F32_ = config("aikopanel.invite_commission", 10);
        $user = \App\Models\User::find($request->user["id"]);
        if($user->commission_rate) {
            $commission_rate = $user->commission_rate;
        }
        $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ = (int) \App\Models\Order::where("status", 3)->where("commission_status", 0)->where("invite_user_id", $request->user["id"])->sum("commission_balance");
        if(config("aikopanel.commission_distribution_enable", 0)) {
            $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ = $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_ * config("aikopanel.commission_distribution_l1") / 100;
        }
        $stat = [(int) \App\Models\User::where("invite_user_id", $request->user["id"])->count(), (int) \App\Models\CommissionLog::where("invite_user_id", $request->user["id"])->sum("get_amount"), $_obfuscated_0D40305C310118040B07321A5C1126240E2C081D400B11_, (int) $commission_rate, (int) $user->commission_balance];
        return response(["data" => ["codes" => $_obfuscated_0D21321C26271831381F370209253C11153B13355B2C11_, "stat" => $stat]]);
    }
}

?>