<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

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
    public function fetch(\App\Http\Requests\Admin\UserFetch $request)
    {
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_ = in_array($request->input("sort_type"), ["ASC", "DESC"]) ? $request->input("sort_type") : "DESC";
        $sort = $request->input("sort") ? $request->input("sort") : "created_at";
        $_obfuscated_0D19071A321914310717171134270417322240260B1D32_ = \App\Models\User::select(\Illuminate\Support\Facades\DB::raw("*"), \Illuminate\Support\Facades\DB::raw("(u+d) as total_used"))->orderBy($sort, $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_);
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
    public function update(\App\Http\Requests\Admin\UserUpdate $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        $user = \App\Models\User::find($request->input("id"));
        if(!$user) {
            abort(500, "Người dùng không tồn tại");
        }
        if(\App\Models\User::where("email", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["email"])->first() && $user->email !== $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["email"]) {
            abort(500, "Email đã được sử dụng");
        }
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["password"])) {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["password"] = password_hash($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["password"], PASSWORD_DEFAULT);
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["password_algo"] = NULL;
        } else {
            unset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["password"]);
        }
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["plan_id"]) != NULL) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["plan_id"]);
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                abort(500, "Kế hoạch đăng ký không tồn tại");
            }
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["group_id"] = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id;
        }
        if($request->input("invite_user_email")) {
            $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ = \App\Models\User::where("email", $request->input("invite_user_email"))->first();
            if($_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["invite_user_id"] = $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->id;
            }
        } else {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["invite_user_id"] = NULL;
        }
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["is_staff"]) && (int) $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["is_staff"] === 0) {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["staff_url"] = NULL;
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["staff_is_sell"] = 0;
            $_obfuscated_0D022E16014003262B1F040C082E13125C1D0D3D360C22_ = config("staff.aikopanel-id-" . $user->id);
            if($_obfuscated_0D022E16014003262B1F040C082E13125C1D0D3D360C22_) {
                $_obfuscated_0D1137323F31170C0C121D23121B34222F303D120C3422_ = base_path("config/staff/aikopanel-id-" . $user->id . ".php");
                if(file_exists($_obfuscated_0D1137323F31170C0C121D23121B34222F303D120C3422_)) {
                    unlink($_obfuscated_0D1137323F31170C0C121D23121B34222F303D120C3422_);
                }
            }
        }
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["banned"]) && (int) $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["banned"] === 1) {
            $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
            $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->removeAllSession();
        }
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["staff_url"]) && (int) $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["is_staff"] === 1) {
            $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ = \App\Models\User::where("staff_url", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["staff_url"])->first();
            if($_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ && $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->id !== $user->id) {
                abort(500, "URL CTV đã được sử dụng, ID CTV sử dụng URL này là: " . $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->id);
            }
        }
        try {
            $user->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        } catch (\Exception $ex) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function dumpCSV(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D19071A321914310717171134270417322240260B1D32_ = \App\Models\User::orderBy("id", "asc");
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
    public function generate(\App\Http\Requests\Admin\UserGenerate $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if($request->input("email_prefix")) {
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
            $user = ["email" => $request->input("email_prefix") . "@" . $request->input("email_suffix"), "invite_user_id" => \App\Models\User::where("email", $request->input("email_staff"))->first()->id ?? NULL, "plan_id" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id : NULL, "group_id" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id : NULL, "reset_traffic_method" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method : NULL, "transfer_enable" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->transfer_enable) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->transfer_enable * 1073741824 : 0, "device_limit" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->device_limit) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->device_limit : NULL, "appleid_limit" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit : NULL, "sni" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni : NULL, "expired_at" => $request->input("expired_at") ?? NULL, "uuid" => \App\Utils\Helper::guid(true), "token" => \App\Utils\Helper::guid()];
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
        for ($i = 0; $i < $request->input("generate_count"); $i++) {
            $user = ["email" => \App\Utils\Helper::randomChar(6) . "@" . $request->input("email_suffix"), "invite_user_id" => \App\Models\User::where("email", $request->input("email_staff"))->first()->id ?? NULL, "plan_id" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id : NULL, "group_id" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id : NULL, "reset_traffic_method" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method : NULL, "transfer_enable" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->transfer_enable) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->transfer_enable * 1073741824 : 0, "device_limit" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->device_limit) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->device_limit : NULL, "appleid_limit" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit : NULL, "sni" => isset($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni) ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni : NULL, "expired_at" => $request->input("expired_at") ?? NULL, "uuid" => \App\Utils\Helper::guid(true), "token" => \App\Utils\Helper::guid(), "created_at" => time(), "updated_at" => time()];
            $user["password"] = password_hash($request->input("password") ?? $user["email"], PASSWORD_DEFAULT);
            array_push($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_, $user);
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        if(!\App\Models\User::insert($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_)) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, "Tạo thất bại");
        }
        \Illuminate\Support\Facades\DB::commit();
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
    public function sendMail(\App\Http\Requests\Admin\UserSendMail $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_ = in_array($request->input("sort_type"), ["ASC", "DESC"]) ? $request->input("sort_type") : "DESC";
        $sort = $request->input("sort") ? $request->input("sort") : "created_at";
        $builder = \App\Models\User::orderBy($sort, $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_);
        $this->filter($request, $builder);
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = $builder->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => $request->input("subject"), "template_name" => "notify", "template_value" => ["name" => config("aikopanel.app_name", "AikoPanel"), "url" => config("aikopanel.app_url"), "content" => $request->input("content")]], "send_email_mass");
        }
        return response(["data" => true]);
    }
    public function ban(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_ = in_array($request->input("sort_type"), ["ASC", "DESC"]) ? $request->input("sort_type") : "DESC";
        $sort = $request->input("sort") ? $request->input("sort") : "created_at";
        $builder = \App\Models\User::orderBy($sort, $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_);
        $this->filter($request, $builder);
        try {
            $builder->update(["banned" => 1]);
        } catch (\Exception $ex) {
            abort(500, "Cập nhật thất bại");
        }
        return response(["data" => true]);
    }
    public function delUser(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->input("id"));
        if(!$user) {
            abort(500, "Người dùng không tồn tại");
        }
        try {
            $_obfuscated_0D5B3C5B16282403262E270C055C2D2C2F34182B1D3911_ = \App\Models\Order::where("user_id", $request->input("id"))->delete();
        } catch (\Exception $ex) {
            abort(500, "Xóa đơn hàng của người dùng thất bại");
        }
        try {
            $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ = \App\Models\User::where("invite_user_id", $request->input("id"))->update(["invite_user_id" => NULL]);
        } catch (\Exception $ex) {
            abort(500, "Cập nhật người giới thiệu thất bại");
        }
        return response(["data" => $user->delete()]);
    }
}

?>