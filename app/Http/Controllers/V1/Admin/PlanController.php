<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class PlanController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D2F011309323E013F0A2A0B22380D343202232F070222_ = \App\Services\PlanService::countActiveUsers();
        $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ = \App\Models\Plan::orderBy("sort", "ASC")->get();
        foreach ($_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->count = 0;
            $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->total = 0;
            foreach ($_obfuscated_0D2F011309323E013F0A2A0B22380D343202232F070222_ as $_obfuscated_0D18092C0404091638043618185B0B1804233907241B11_ => $_obfuscated_0D3D362D195C0D045C2F335B05031D0C3C2D31165C1832_) {
                if($_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->id === $_obfuscated_0D2F011309323E013F0A2A0B22380D343202232F070222_[$_obfuscated_0D18092C0404091638043618185B0B1804233907241B11_]->plan_id) {
                    $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->count = $_obfuscated_0D2F011309323E013F0A2A0B22380D343202232F070222_[$_obfuscated_0D18092C0404091638043618185B0B1804233907241B11_]->count;
                }
            }
            $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->total = \App\Models\User::where("plan_id", $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_[$k]->id)->count();
        }
        $_obfuscated_0D153E31401E3C1633051519040F3C1E3D183C32233932_ = \App\Models\User::where("is_staff", 1)->whereNotNull("staff_url")->get(["id", "staff_url"]);
        return response(["data" => $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_, "idStaff" => $_obfuscated_0D153E31401E3C1633051519040F3C1E3D183C32233932_]);
    }
    public function save(\App\Http\Requests\Admin\PlanSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        if($request->input("id")) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("id"));
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                abort(500, "Đăng ký này không tồn tại");
            }
            \Illuminate\Support\Facades\DB::beginTransaction();
            try {
                if($request->input("force_update")) {
                    $_obfuscated_0D070539270C080E242738251A3232011127230F010C22_ = ["group_id" => $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["group_id"], "transfer_enable" => $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["transfer_enable"] * 1073741824, "device_limit" => $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["device_limit"], "speed_limit" => $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["speed_limit"]];
                    if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni != $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["sni"]) {
                        $_obfuscated_0D070539270C080E242738251A3232011127230F010C22_["sni"] = $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["sni"];
                    }
                    if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit != $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["appleid_limit"]) {
                        $_obfuscated_0D070539270C080E242738251A3232011127230F010C22_["appleid_limit"] = $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["appleid_limit"];
                    }
                    if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method != $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["reset_traffic_method"] && \App\Models\User::where("plan_id", $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id)->whereNotNull("expired_at")->where("expired_at", ">", time())->first()) {
                        $_obfuscated_0D070539270C080E242738251A3232011127230F010C22_["reset_traffic_method"] = $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["reset_traffic_method"];
                    }
                    \App\Models\User::where("plan_id", $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id)->update($_obfuscated_0D070539270C080E242738251A3232011127230F010C22_);
                }
                $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
            } catch (\Exception $ex) {
                \Illuminate\Support\Facades\DB::rollBack();
                \Log::error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_);
                abort(500, "Lưu thất bại");
            }
            \Illuminate\Support\Facades\DB::commit();
            return response(["data" => true]);
        }
        if(!\App\Models\Plan::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
            abort(500, "Tạo thất bại");
        }
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if(\App\Models\Order::where("plan_id", $request->input("id"))->first()) {
            abort(500, "Đã có đơn hàng trong đăng ký này, không thể xóa");
        }
        if(\App\Models\User::where("plan_id", $request->input("id"))->first()) {
            abort(500, "Đã có người dùng trong đăng ký này, không thể xóa");
        }
        if($request->input("id")) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("id"));
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                abort(500, "Đăng ký này không tồn tại");
            }
        }
        return response(["data" => $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->delete()]);
    }
    public function update(\App\Http\Requests\Admin\PlanUpdate $request)
    {
        $_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_ = $request->only(["show", "renew"]);
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("id"));
        if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
            abort(500, "Đăng ký này không tồn tại");
        }
        try {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->update($_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_);
        } catch (\Exception $ex) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function sort(\App\Http\Requests\Admin\PlanSort $request)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        foreach ($request->input("plan_ids") as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!\App\Models\Plan::find($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_)->update(["sort" => $k + 1])) {
                \Illuminate\Support\Facades\DB::rollBack();
                abort(500, "Lưu thất bại");
            }
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => true]);
    }
}

?>