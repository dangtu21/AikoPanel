<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Client\Protocols;

class IDAPPLE
{
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function handle()
    {
        $user = $this->user;
        $_obfuscated_0D2D0A11340A12172C133F0D131005111712292D3F1801_ = request()->gethost();
        $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ = \App\Models\User::where("staff_url", "like", "%" . $_obfuscated_0D2D0A11340A12172C133F0D131005111712292D3F1801_ . "%")->first();
        $_obfuscated_0D290105141806211D2D28171E150713071C2E17263B11_ = $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ ? parse_url($_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->staff_url, PHP_URL_HOST) : NULL;
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = "AikoPanel";
        if($_obfuscated_0D290105141806211D2D28171E150713071C2E17263B11_ === $_obfuscated_0D2D0A11340A12172C133F0D131005111712292D3F1801_) {
            $id = $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->id;
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("staff.aikopanel-id-" . $id . ".app_name", "AikoPanel");
        } else {
            $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("aikopanel.app_name", "AikoPanel");
        }
        $url = config("aikopanel.appleid_api");
        if(empty($url)) {
            return view("appleid.error", ["message" => "🙅🏻‍♂️ Admin Chưa cài đặt URL lấy appleid, Vui lòng liên hệ admin để admin cài đặt chức năng lấy appleid."]);
        }
        if($user["plan_id"] == 0 || $user["plan_id"] === NULL) {
            return view("idapple.error", ["message" => "🙅🏻‍♂️ Bạn chưa đăng ký gói dịch vụ nào."]);
        }
        $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = "apple_ids";
        $_obfuscated_0D5C350F283E2E07100E255B0C021A2F31334017070C11_ = \Illuminate\Support\Facades\Cache::get($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_);
        if(!$_obfuscated_0D5C350F283E2E07100E255B0C021A2F31334017070C11_) {
            return view("appleid.error", ["message" => "🙅🏻‍♂️ Lỗi lấy Apple ID từ server. Vui lòng thử lại sau."]);
        }
        $_obfuscated_0D12142933261D1E233638122D04071A3406165B070F11_ = $_obfuscated_0D5C350F283E2E07100E255B0C021A2F31334017070C11_[0] ?? NULL;
        if(!$_obfuscated_0D12142933261D1E233638122D04071A3406165B070F11_) {
            return view("appleid.error", ["message" => "Không tìm thấy tài khoản Apple ID."]);
        }
        if($user->appleid_limit === NULL || 0 < $user->appleid_limit) {
            \Illuminate\Support\Facades\DB::table("v2_user")->where("uuid", $user["uuid"])->update(["appleid_limit" => \Illuminate\Support\Facades\DB::raw("appleid_limit - 1")]);
            $user->appleid_limit -= 1;
            return view("appleid.appleid", ["username" => $_obfuscated_0D12142933261D1E233638122D04071A3406165B070F11_["username"], "password" => $_obfuscated_0D12142933261D1E233638122D04071A3406165B070F11_["password"], "appname" => $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_, "statusid" => $_obfuscated_0D12142933261D1E233638122D04071A3406165B070F11_["status"] ? "🟢 Đang Hoạt Động" : "🔴 Đang Bảo Trì", "appleidlimit" => $user->appleid_limit !== NULL ? $user->appleid_limit : "∞", "quantumultx" => config("aikopanel.appleid_quanx")]);
        }
        return view("appleid.error", ["message" => "🙅🏻‍♂️ Bạn đã hết lượt lấy Apple ID. Vui lòng liên hệ admin để được hỗ trợ."]);
    }
}

?>