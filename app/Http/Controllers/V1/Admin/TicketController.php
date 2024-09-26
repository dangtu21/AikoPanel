<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class TicketController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        if($request->input("id")) {
            $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("id", $request->input("id"))->first();
            if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
                abort(500, "Ticket không tồn tại");
            }
            $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"] = \App\Models\TicketMessage::where("ticket_id", $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->id)->get();
            for ($i = 0; $i < count($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"]); $i++) {
                if($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["user_id"] !== $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->user_id) {
                    $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["is_me"] = true;
                } else {
                    $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["is_me"] = false;
                }
            }
            return response(["data" => $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_]);
        }
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\Ticket::orderBy("updated_at", "DESC");
        if($request->input("status") !== NULL) {
            $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->where("status", $request->input("status"));
        }
        if($request->input("reply_status") !== NULL) {
            $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->whereIn("reply_status", $request->input("reply_status"));
        }
        if($request->input("email") !== NULL) {
            $user = \App\Models\User::where("email", $request->input("email"))->first();
            if($user) {
                $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->where("user_id", $user->id);
            }
        }
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->count();
        $res = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return response(["data" => $res, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
    public function reply(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!$request->input("id")) {
            abort(500, "Sai tham số");
        }
        if(!$request->input("message")) {
            abort(500, "Nội dung không được để trống");
        }
        $_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_ = new \App\Services\TicketService();
        $_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_->replyByAdmin($request->input("id"), $request->input("message"), $request->user["id"]);
        return response(["data" => true]);
    }
    public function close(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!$request->input("id")) {
            abort(500, "Sai tham số");
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("id", $request->input("id"))->first();
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
            abort(500, "Ticket không tồn tại");
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->status = 1;
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->save()) {
            abort(500, "Đóng thất bại");
        }
        return response(["data" => true]);
    }
}

?>