<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class UserController extends \App\Http\Controllers\Controller
{
    public function getActiveSession(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
        return response(["data" => $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->getSessions()]);
    }
    public function removeActiveSession(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
        return response(["data" => $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->removeSession($request->input("session_id"))]);
    }
    public function checkLogin(\Illuminate\Http\Request $request)
    {
        $data = ["is_login" => $request->user["id"] ? true : false];
        if($request->user["is_admin"]) {
            $data["is_admin"] = true;
        }
        if($request->user["is_staff"]) {
            $data["is_staff"] = true;
        }
        return response(["data" => $data]);
    }
    public function changePassword(\App\Http\Requests\User\UserChangePassword $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        if(!\App\Utils\Helper::multiPasswordVerify($user->password_algo, $user->password_salt, $request->input("old_password"), $user->password)) {
            abort(500, __("The old password is wrong"));
        }
        $user->password = password_hash($request->input("new_password"), PASSWORD_DEFAULT);
        $user->password_algo = NULL;
        $user->password_salt = NULL;
        if(!$user->save()) {
            abort(500, __("Save failed"));
        }
        return response(["data" => true]);
    }
    public function changeSNI(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $user->sni = $request->input("sni");
        if(!$user->save()) {
            abort(500, __("Save failed"));
        }
        return response(["data" => true]);
    }
    public function changeAvatar(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $user->avatar_url = $request->input("avatar");
        if(!$user->save()) {
            abort(500, __("Save failed"));
        }
        return response(["data" => true]);
    }
    public function changeUserName(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $_obfuscated_0D272D300B023D2527262C32250421370B150A37020F01_ = $request->input("username");
        if(strlen($_obfuscated_0D272D300B023D2527262C32250421370B150A37020F01_) < 4) {
            abort(500, __("Username must be at least 4 characters"));
        }
        $_obfuscated_0D2828292D083224341D123911310D02353140120C0E11_ = \App\Models\User::where("username", $_obfuscated_0D272D300B023D2527262C32250421370B150A37020F01_)->where("id", "<>", $user->id)->first();
        if($_obfuscated_0D2828292D083224341D123911310D02353140120C0E11_) {
            abort(500, __("Username already exists"));
        }
        $user->username = $_obfuscated_0D272D300B023D2527262C32250421370B150A37020F01_;
        if(!$user->save()) {
            abort(500, __("Save failed"));
        }
        return response(["data" => true]);
    }
    public function info(\Illuminate\Http\Request $request)
    {
        $url = $request->server("HTTP_HOST");
        $user = \App\Models\User::where("id", $request->user["id"])->select(["id", "email", "username", "avatar_url", "transfer_enable", "device_limit", "appleid_limit", "last_login_at", "created_at", "banned", "remind_expire", "remind_traffic", "expired_at", "balance", "commission_balance", "plan_id", "sni", "discount", "commission_rate", "telegram_id", "uuid"])->first();
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_ = base_path() . "/resources/rules/custom.sni.json";
        $_obfuscated_0D35370C3D1608363E363518262B3908081416283B4022_ = base_path() . "/resources/rules/default.sni.json";
        if(file_exists($_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_)) {
            $_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_ = file_get_contents($_obfuscated_0D0A31350417351C1D362B3201400A3D35045B19122301_);
            $_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ = json_decode($_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_, true);
        } else {
            $_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_ = file_get_contents($_obfuscated_0D35370C3D1608363E363518262B3908081416283B4022_);
            $_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ = json_decode($_obfuscated_0D3F283B1B313D06302D3E223B0D0625121D0938352D32_, true);
        }
        if(is_null($user->sni)) {
            $sni = "default";
        } else {
            $sni = $user->sni;
        }
        foreach ($_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ as $key => $value) {
            if($user->sni == $value["value"]) {
                $sni = $value["lable"];
            }
        }
        $user["sni"] = $sni;
        $_obfuscated_0D2F271A2E221C1D0212010E25270F0E0F261418312A22_ = $request->header("CF-Connecting-IP") ?? $request->ip();
        $user["last_login_ip"] = $_obfuscated_0D2F271A2E221C1D0212010E25270F0E0F261418312A22_ ?? $user->last_login_ip;
        $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ = \App\Models\User::where("staff_url", $url)->first();
        if($_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_) {
            $id = $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->id;
            $user["staff_zalo"] = config("staff.aikopanel-id-" . $id . ".zalo_discuss_link");
            $user["staff_telegram"] = config("staff.aikopanel-id-" . $id . ".telegram_discuss_link");
        }
        if(is_null($user->avatar_url)) {
            $user["avatar_url"] = "https://cdn.v2ex.com/gravatar/" . md5($user->email) . "?s=64&d=identicon";
        }
        return response(["data" => $user]);
    }
    public function getStat(\Illuminate\Http\Request $request)
    {
        $stat = [\App\Models\Order::where("status", 0)->where("user_id", $request->user["id"])->count(), \App\Models\Ticket::where("status", 0)->where("user_id", $request->user["id"])->count(), \App\Models\User::where("invite_user_id", $request->user["id"])->count()];
        return response(["data" => $stat]);
    }
    public function getSubscribe(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::where("id", $request->user["id"])->select(["plan_id", "token", "u", "d", "transfer_enable", "device_limit", "appleid_limit", "email", "uuid", "expired_at"])->first();
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        if($user->plan_id) {
            $user["plan"] = \App\Models\Plan::find($user->plan_id);
            if(!$user["plan"]) {
                abort(500, __("Subscription plan does not exist"));
            }
        }
        $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_ = 0;
        $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_ = \Illuminate\Support\Facades\Cache::get("ALIVE_IP_USER_" . $request->user["id"]);
        $_obfuscated_0D5C3C063E3708141D1D5B1222353D3D343C25172C0832_ = $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_ ? implode(", ", array_keys($_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_["aliveips"])) : "Không có IP hoạt động";
        if($_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_) {
            $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_ = $_obfuscated_0D180832183B28171511402C0C26390D3D3B0F0C0E3D32_["alive_ip"];
        }
        $user["alive_ip"] = $_obfuscated_0D3B2B033B3D3213122410213712041B110F33345C1B32_;
        $user["ip_online"] = $_obfuscated_0D5C3C063E3708141D1D5B1222353D3D343C25172C0832_;
        $user["subscribe_url"] = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user["token"]);
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        $user["reset_day"] = $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->getResetDay($user);
        return response(["data" => $user]);
    }
    public function resetSecurity(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $user->uuid = \App\Utils\Helper::guid(true);
        $user->token = \App\Utils\Helper::guid();
        if(!$user->save()) {
            abort(500, __("Reset failed"));
        }
        return response(["data" => \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user->token)]);
    }
    public function update(\App\Http\Requests\User\UserUpdate $request)
    {
        $_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_ = $request->only(["remind_expire", "remind_traffic"]);
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        try {
            $user->update($_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_);
        } catch (\Exception $ex) {
            abort(500, __("Save failed"));
        }
        return response(["data" => true]);
    }
    public function transfer(\App\Http\Requests\User\UserTransfer $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        if($user->commission_balance < $request->input("transfer_amount")) {
            abort(500, __("Insufficient commission balance"));
        }
        $user->commission_balance = $user->commission_balance - $request->input("transfer_amount");
        $user->balance = $user->balance + $request->input("transfer_amount");
        if(!$user->save()) {
            abort(500, __("Transfer failed"));
        }
        return response(["data" => true]);
    }
    public function getQuickLoginUrl(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ = \App\Utils\Helper::guid();
        $key = \App\Utils\CacheKey::get("TEMP_TOKEN", $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_);
        \Illuminate\Support\Facades\Cache::put($key, $user->id, 60);
        $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_ = "/#/login?verify=" . $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ . "&redirect=" . ($request->input("redirect") ? $request->input("redirect") : "dashboard");
        if(config("aikopanel.app_url")) {
            $url = config("aikopanel.app_url") . $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_;
        } else {
            $url = url($_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_);
        }
        return response(["data" => $url]);
    }
    public function Applications(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D28272E2D2A5B2129060B31063B3B08161C1422093422_ = ["Windows" => config("aikopanel.app_windows_enable", 1) ? ["clash" => config("aikopanel.app_windows_cfa") ? ["name" => "Clash for Windows", "version" => "v0.20.39", "price" => "Miễn phí", "link" => "https://clashforwindows.net/files/Clash.for.Windows.Setup.0.20.39.exe"] : NULL, "nekoray" => config("aikopanel.app_windows_nekoray", 1) ? ["name" => "Nekoray", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/MatsuriDayo/nekoray/releases/latest"] : NULL, "netch" => config("aikopanel.app_windows_netch", 1) ? ["name" => "Netch", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/netchx/netch/releases/latest"] : NULL, "v2rayn" => config("aikopanel.app_windows_v2rayn", 1) ? ["name" => "V2RayN", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/2dust/v2rayN/releases/latest"] : NULL, "karing" => config("aikopanel.app_windows_karing", 1) ? ["name" => "Karing", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/KaringX/karing/releases/latest"] : NULL] : NULL, "macOS" => config("aikopanel.app_macos_enable", 1) ? ["singbox" => config("aikopanel.app_macos_sb", 1) ? ["name" => "Sing-Box", "version" => "Latest", "price" => "Miễn phí", "link" => "https://apps.apple.com/us/app/sing-box/id6451272673"] : NULL, "clashx" => config("aikopanel.app_macos_clashx", 1) ? ["name" => "ClashX", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/passwa11/ClashX/releases/latest"] : NULL, "cfw" => config("aikopanel.app_macos_cfw", 1) ? ["name" => "Clash for Windows", "version" => "v0.20.39", "price" => "Miễn phí", "link" => "https://clashforwindows.net/files/Clash.for.Windows-0.20.39.dmg"] : NULL, "shadowrocket" => config("aikopanel.app_macos_shadowrocket", 1) ? ["name" => "Shadowrocket", "version" => "Latest", "price" => "79.000đ", "link" => "https://apps.apple.com/vn/app/shadowrocket/id932747118"] : NULL, "quantumultx" => config("aikopanel.app_macos_qx", 1) ? ["name" => "Quantumult X", "version" => "Latest", "price" => "199.000đ", "link" => "https://apps.apple.com/vn/app/quantumult-x/id1443988620"] : NULL, "karing" => config("aikopanel.app_macos_karing", 1) ? ["name" => "Karing", "version" => "Latest", "price" => "Miễn phí", "link" => "https://apps.apple.com/us/app/karing/id6472431552"] : NULL] : NULL, "iOS" => config("aikopanel.app_ios_enable", 1) ? ["singbox" => config("aikopanel.app_ios_sb", 1) ? ["name" => "Sing-Box", "version" => "Latest", "price" => "Miễn phí", "link" => "https://apps.apple.com/vn/app/sing-box/id6451272673"] : NULL, "shadowrocket" => config("aikopanel.app_ios_shadowrocket", 1) ? ["name" => "Shadowrocket", "version" => "Latest", "price" => "79.000đ", "link" => "https://apps.apple.com/vn/app/shadowrocket/id932747118"] : NULL, "quantumultx" => config("aikopanel.app_ios_qx", 1) ? ["name" => "Quantumult-X", "version" => "Latest", "price" => "199.000đ", "link" => "https://apps.apple.com/vn/app/quantumult-x/id1443988620"] : NULL, "surge" => config("aikopanel.app_ios_surge", 1) ? ["name" => "Surge", "version" => "Latest", "price" => "1.299.000đ", "link" => "https://apps.apple.com/vn/app/surge-5/id1442620678"] : NULL, "stash" => config("aikopanel.app_ios_stash", 1) ? ["name" => "Stash", "version" => "Latest", "price" => "99.000đ", "link" => "https://apps.apple.com/vn/app/stash-rule-based-proxy/id1596063349"] : NULL, "karing" => config("aikopanel.app_ios_karing", 1) ? ["name" => "Karing", "version" => "latest", "price" => "Miễn phí", "link" => "https://apps.apple.com/us/app/karing/id6472431552"] : NULL] : NULL, "Android" => config("aikopanel.app_android_enable", 1) ? ["singbox" => config("aikopanel.app_android_sb", 1) ? ["name" => "Sing-Box", "version" => "Latest", "price" => "Miễn phí", "link" => "https://play.google.com/store/apps/details?id=io.nekohasekai.sfa&hl=vi_VN&pli=1"] : NULL, "cfa" => config("aikopanel.app_android_cfa", 1) ? ["name" => "Clash for Android", "version" => "v2.5.12", "price" => "Miễn phí", "link" => "https://drive.google.com/uc?export=download&id=1pSvwUsKF0Vzksz8bZDu9J4JEmjKNJFdM"] : NULL, "nekobox" => config("aikopanel.app_android_nekobox", 1) ? ["name" => "NekoBox", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/MatsuriDayo/NekoBoxForAndroid/releases/latest"] : NULL, "meta" => config("aikopanel.app_android_meta", 1) ? ["name" => "ClashMeta", "version" => "Latest", "price" => "Miễn phí", "link" => "https://github.com/MetaCubeX/ClashMetaForAndroid/releases/latest"] : NULL, "surfboard" => config("aikopanel.app_android_surfboard", 1) ? ["name" => "Surfboard", "version" => "Latest", "price" => "Miễn phí", "link" => "https://play.google.com/store/apps/details?id=com.getsurfboard&hl=vi_VN"] : NULL, "v2rayng" => config("aikopanel.app_android_v2rayng", 1) ? ["name" => "V2RayNG", "version" => "Latest", "price" => "Miễn phí", "link" => "https://play.google.com/store/apps/details?id=com.v2ray.ang&hl=vi&gl=VN"] : NULL] : NULL];
        return response(["data" => $_obfuscated_0D28272E2D2A5B2129060B31063B3B08161C1422093422_]);
    }
}

?>