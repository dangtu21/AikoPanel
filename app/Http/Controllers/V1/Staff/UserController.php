<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff;

class UserController extends \App\Http\Controllers\Controller
{
    public function resetSecret(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->input("id"));
        if(!$user) {
            abort(500, "Người dùng không tồn tại");
        }
        $user->token = \App\Utils\Helper::guid();
        $user->uuid = \App\Utils\Helper::guid(true);
        return response(["data" => $user->save()]);
    }
    private function filter(\Illuminate\Http\Request $request, $builder)
    {
        $_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_ = $request->input("filter");
        if($_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_) {
            foreach ($_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_ as $k => $filter) {
                if($filter["condition"] === "~") {
                    $filter["condition"] = "like";
                    $filter["value"] = "%" . $filter["value"] . "%";
                }
                if($filter["key"] === "d" || $filter["key"] === "transfer_enable") {
                    $filter["value"] = $filter["value"] * 1073741824;
                }
                if($filter["key"] === "invite_by_email") {
                    $user = \App\Models\User::where("email", $filter["condition"], $filter["value"])->first();
                    $_obfuscated_0D0A0C2F1C405C1F0F2E18100624333816131E15122D32_ = isset($user->id) ? $user->id : 0;
                    $builder->where("invite_user_id", $_obfuscated_0D0A0C2F1C405C1F0F2E18100624333816131E15122D32_);
                    unset($_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_[$k]);
                } else {
                    $builder->where($filter["key"], $filter["condition"], $filter["value"]);
                }
            }
        }
    }
    public function fetch(\App\Http\Requests\Staff\UserFetch $request)
    {
        $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = $request->user["id"];
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_ = in_array($request->input("sort_type"), ["ASC", "DESC"]) ? $request->input("sort_type") : "DESC";
        $sort = $request->input("sort") ? $request->input("sort") : "created_at";
        $_obfuscated_0D19071A321914310717171134270417322240260B1D32_ = \App\Models\User::select(\Illuminate\Support\Facades\DB::raw("*"), \Illuminate\Support\Facades\DB::raw("(u+d) as total_used"))->where("invite_user_id", "=", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_)->orderBy($sort, $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_);
        $this->filter($request, $_obfuscated_0D19071A321914310717171134270417322240260B1D32_);
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D19071A321914310717171134270417322240260B1D32_->count();
        $res = $_obfuscated_0D19071A321914310717171134270417322240260B1D32_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::get();
        for ($i = 0; $i < count($res); $i++) {
            for ($k = 0; $k < count($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_); $k++) {
                if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["id"] == $res[$i]["plan_id"]) {
                    $res[$i]["plan_name"] = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["name"];
                }
            }
            $res[$i]["invited_user_count"] = \App\Models\User::where("invite_user_id", $res[$i]["id"])->count();
            $res[$i]["subscribe_url"] = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $res[$i]["token"]);
            $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_ = 0;
            $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_ = \Illuminate\Support\Facades\Cache::get("ALIVE_IP_USER_" . $res[$i]["id"]);
            $_obfuscated_0D5C3C063E3708141D1D5B1222353D3D343C25172C0832_ = $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_ ? implode(",", array_keys($_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_["aliveips"])) : "";
            if($_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_) {
                $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_ = $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_["alive_ip"];
            }
            $res[$i]["alive_ip"] = $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_;
            $res[$i]["ip_online"] = $_obfuscated_0D5C3C063E3708141D1D5B1222353D3D343C25172C0832_;
        }
        return response(["data" => $res, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
    public function getUserInfoById(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!$request->input("id")) {
            abort(500, "Tham số không hợp lệ");
        }
        $user = \App\Models\User::find($request->input("id"));
        if($user->invite_user_id) {
            $user["invite_user"] = \App\Models\User::find($user->invite_user_id);
        }
        return response(["data" => $user]);
    }
    public function dumpCSV(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D19071A321914310717171134270417322240260B1D32_ = \App\Models\User::orderBy("id", "asc")->where("invite_user_id", $request->user["id"])->orWhere("id", $request->user["id"]);
        $this->filter($request, $_obfuscated_0D19071A321914310717171134270417322240260B1D32_);
        $res = $_obfuscated_0D19071A321914310717171134270417322240260B1D32_->get();
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::get();
        for ($i = 0; $i < count($res); $i++) {
            for ($k = 0; $k < count($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_); $k++) {
                if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["id"] == $res[$i]["plan_id"]) {
                    $res[$i]["plan_name"] = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["name"];
                }
            }
        }
        $data = "Email, Số dư, Hoa hồng khuyến mãi, Tổng lưu lượng, Giới hạn số thiết bị, Lưu lượng còn lại, Thời gian kết thúc gói cước, Kế hoạch đăng ký, Địa chỉ đăng ký\r\n";
        foreach ($res as $user) {
            $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_ = $user["expired_at"] === NULL ? "Vĩnh viễn" : date("d-m-Y H:i:s", $user["expired_at"]);
            $_obfuscated_0D33022C29060F2C08161D3D101D0C272B190639042D32_ = $user["balance"] / 100;
            $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_ = $user["commission_balance"] / 100;
            $_obfuscated_0D2F2808350C2F172B16230F5C163B2C1A1E07221F3F22_ = $user["transfer_enable"] ? $user["transfer_enable"] / 1073741824 : 0;
            $_obfuscated_0D400D2B28062139161807193D15142F5C36042D3C1201_ = $user["devce_limit"] ? $user["devce_limit"] : NULL;
            $_obfuscated_0D24371B21355C2A401F3405073B3433252D3539233701_ = ($user["transfer_enable"] - ($user["u"] + $user["d"])) / 1073741824 ?? 0;
            $_obfuscated_0D0B1F19072C0F231E31265B3D1F265B400B5B15320F01_ = $user["plan_name"] ?? "Không có đăng ký";
            $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user["token"]);
            $data .= $user["email"] . "," . $_obfuscated_0D33022C29060F2C08161D3D101D0C272B190639042D32_ . "," . $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_ . "," . $_obfuscated_0D2F2808350C2F172B16230F5C163B2C1A1E07221F3F22_ . ", " . $_obfuscated_0D400D2B28062139161807193D15142F5C36042D3C1201_ . ", " . $_obfuscated_0D24371B21355C2A401F3405073B3433252D3539233701_ . "," . $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_ . "," . $_obfuscated_0D0B1F19072C0F231E31265B3D1F265B400B5B15320F01_ . "," . $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ . "\r\n";
        }
        echo "﻿" . $data;
    }
    public function generate(\App\Http\Requests\Staff\UserGenerate $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if($request->input("email_prefix")) {
            $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = $request->user["id"];
            $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ = now()->endOfDay()->diffInSeconds();
            $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("STAFF_GENERATE_USER_LIMIT", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_), 0);
            if(config("aikopanel.staff_generate_user_limit") <= $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_) {
                abort(500, "Bạn đã vượt quá giới hạn tạo tài khoản người dùng, Vui lòng thử lại vào ngày mai");
            } else {
                \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("STAFF_GENERATE_USER_LIMIT", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_), $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ + 1, $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_);
            }
            if($request->input("plan_id")) {
                $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("plan_id"));
                if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                    abort(500, "Plan đăng ký không tồn tại");
                }
            }
            if($request->input("email_staff")) {
                $user = \App\Models\User::where("email", $request->input("email_staff"))->first();
                if(!$user) {
                    abort(500, "Email nhân viên không tồn tại");
                }
            }
            $user = ["email" => $request->input("email_prefix") . "@" . $request->input("email_suffix"), "invite_user_id" => $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ ?? NULL, "plan_id" => NULL, "group_id" => NULL, "reset_traffic_method" => NULL, "transfer_enable" => 0, "device_limit" => NULL, "appleid_limit" => NULL, "sni" => NULL, "expired_at" => NULL, "uuid" => \App\Utils\Helper::guid(true), "token" => \App\Utils\Helper::guid()];
            if(\App\Models\User::where("email", $user["email"])->first()) {
                abort(500, "Email đã được sử dụng");
            }
            $user["password"] = password_hash($request->input("password") ?? $user["email"], PASSWORD_DEFAULT);
            if(!\App\Models\User::create($user)) {
                abort(500, "Tạo thất bại");
            }
            return response(["data" => true]);
        }
        if($request->input("generate_count")) {
            $this->multiGenerate($request);
        }
    }
    private function multiGenerate(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = $request->user["id"];
        $_obfuscated_0D292A2B391930402822180F152D1E1F39303428312E22_ = $request->input("generate_count");
        $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ = now()->endOfDay()->diffInSeconds();
        $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("STAFF_GENERATE_USER_LIMIT", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_), 0);
        if(config("aikopanel.staff_generate_user_limit") < $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ + $_obfuscated_0D292A2B391930402822180F152D1E1F39303428312E22_) {
            if(config("aikopanel.staff_generate_user_limit") <= $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_) {
                abort(500, "Bạn đã vượt quá giới hạn tạo tài khoản người dùng, Vui lòng thử lại vào ngày mai");
            } else {
                abort(500, "Bạn đã vượt quá giới hạn tạo tài khoản người dùng, số lần tạo còn lại trong ngày là " . (config("aikopanel.staff_generate_user_limit") - $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_) . " lần");
            }
        }
        if($request->input("plan_id")) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("plan_id"));
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                abort(500, "Plan đăng ký không tồn tại");
            }
        }
        if($request->input("email_staff")) {
            $user = \App\Models\User::where("email", $request->input("email_staff"))->first();
            if(!$user) {
                abort(500, "Email nhân viên không tồn tại");
            }
        }
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = [];
        for ($i = 0; $i < $_obfuscated_0D292A2B391930402822180F152D1E1F39303428312E22_; $i++) {
            $user = ["email" => \App\Utils\Helper::randomChar(6) . "@" . $request->input("email_suffix"), "invite_user_id" => $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ ?? NULL, "plan_id" => NULL, "group_id" => NULL, "reset_traffic_method" => NULL, "transfer_enable" => 0, "device_limit" => NULL, "appleid_limit" => NULL, "sni" => NULL, "expired_at" => NULL, "uuid" => \App\Utils\Helper::guid(true), "token" => \App\Utils\Helper::guid(), "created_at" => time(), "updated_at" => time()];
            $user["password"] = password_hash($request->input("password") ?? $user["email"], PASSWORD_DEFAULT);
            array_push($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_, $user);
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            if(!\App\Models\User::insert($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_)) {
                throw new \Exception("Tạo thất bại");
            }
            \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("STAFF_GENERATE_USER_LIMIT", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_), $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ + $_obfuscated_0D292A2B391930402822180F152D1E1F39303428312E22_, $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_);
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
        $data = "Tài khoản, Mật khẩu, Thời gian hết hạn, UUID, Thời gian tạo, Địa chỉ đăng ký\r\n";
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_ = $user["expired_at"] === NULL ? "Vĩnh viễn" : date("d-m-Y H:i:s", $user["expired_at"]);
            $_obfuscated_0D344013213E311437031E0A3C013C053E0B0B1A173011_ = date("d-m-Y H:i:s", $user["created_at"]);
            $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ = $request->input("password") ?? $user["email"];
            $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user["token"]);
            $data .= $user["email"] . "," . $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ . "," . $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_ . "," . $user["uuid"] . "," . $_obfuscated_0D344013213E311437031E0A3C013C053E0B0B1A173011_ . "," . $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ . "\r\n";
        }
        echo $data;
    }
}

?>