<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Passport;

class AuthController extends \App\Http\Controllers\Controller
{
    public function loginWithMailLink(\Illuminate\Http\Request $request)
    {
        if(!(int) config("aikopanel.login_with_mail_link_enable")) {
            abort(404);
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validate(["email" => "required|email:strict", "redirect" => "nullable"]);
        if(\Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("LAST_SEND_LOGIN_WITH_MAIL_LINK_TIMESTAMP", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["email"]))) {
            abort(500, __("Sending frequently, please try again later"));
        }
        $user = \App\Models\User::where("email", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["email"])->first();
        if(!$user) {
            return response(["data" => true]);
        }
        $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ = \App\Utils\Helper::guid();
        $key = \App\Utils\CacheKey::get("TEMP_TOKEN", $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_);
        \Illuminate\Support\Facades\Cache::put($key, $user->id, 300);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("LAST_SEND_LOGIN_WITH_MAIL_LINK_TIMESTAMP", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["email"]), time(), 60);
        $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_ = "/#/login?verify=" . $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ . "&redirect=" . ($request->input("redirect") ? $request->input("redirect") : "dashboard");
        if(config("aikopanel.app_url")) {
            $link = config("aikopanel.app_url") . $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_;
        } else {
            $link = url($_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_);
        }
        \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => __("Login to :name", ["name" => config("aikopanel.app_name", "AikoPanel")]), "template_name" => "login", "template_value" => ["name" => config("aikopanel.app_name", "AikoPanel"), "link" => $link, "url" => config("aikopanel.app_url")]]);
        return response(["data" => $link]);
    }
    public function register(\App\Http\Requests\Passport\AuthRegister $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if((int) config("aikopanel.register_limit_by_ip_enable", 0)) {
            $_obfuscated_0D2B5C5B36172A34175C3C3D0E1A3528313C1737281C32_ = \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("REGISTER_IP_RATE_LIMIT", $request->ip())) ?? 0;
            if((int) config("aikopanel.register_limit_count", 3) <= (int) $_obfuscated_0D2B5C5B36172A34175C3C3D0E1A3528313C1737281C32_) {
                abort(500, __("Register frequently, please try again after :minute minute", ["minute" => config("aikopanel.register_limit_expire", 60)]));
            }
        }
        if((int) config("aikopanel.recaptcha_enable", 0)) {
            $_obfuscated_0D361301250C361C04262A0E3E0F24271733260A212411_ = new \ReCaptcha\ReCaptcha(config("aikopanel.recaptcha_key"));
            $_obfuscated_0D1C2237051E0A3F1E1530372D5C02371E123923292622_ = $_obfuscated_0D361301250C361C04262A0E3E0F24271733260A212411_->verify($request->input("recaptcha_data"));
            if(!$_obfuscated_0D1C2237051E0A3F1E1530372D5C02371E123923292622_->isSuccess()) {
                abort(500, __("Invalid code is incorrect"));
            }
        }
        if((int) config("aikopanel.email_whitelist_enable", 0) && !\App\Utils\Helper::emailSuffixVerify($request->input("email"), config("aikopanel.email_whitelist_suffix", \App\Utils\Dict::EMAIL_WHITELIST_SUFFIX_DEFAULT))) {
            abort(500, __("Email suffix is not in the Whitelist"));
        }
        if((int) config("aikopanel.email_gmail_limit_enable", 0)) {
            list($_obfuscated_0D361C0133340E3F313013232F03252C2B27390F2A1A01_) = explode("@", $request->input("email"));
            if(strpos($_obfuscated_0D361C0133340E3F313013232F03252C2B27390F2A1A01_, ".") !== false || strpos($_obfuscated_0D361C0133340E3F313013232F03252C2B27390F2A1A01_, "+") !== false) {
                abort(500, __("Gmail alias is not supported"));
            }
        }
        if((int) config("aikopanel.stop_register", 0)) {
            abort(500, __("Registration has closed"));
        }
        if((int) config("aikopanel.invite_force", 0) && !$request->input("invite_code")) {
            abort(500, __("You must use the invitation code to register"));
        }
        if((int) config("aikopanel.email_verify", 0)) {
            if(!$request->input("email_code")) {
                abort(500, __("Email verification code cannot be empty"));
            }
            if((string) \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("EMAIL_VERIFY_CODE", $request->input("email"))) !== (string) $request->input("email_code")) {
                abort(500, __("Incorrect email verification code"));
            }
        }
        $email = $request->input("email");
        $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ = $request->input("password");
        $_obfuscated_0D28172103333330041A2535252F3F3833012A08050332_ = \App\Models\User::where("email", $email)->first();
        if($_obfuscated_0D28172103333330041A2535252F3F3833012A08050332_) {
            abort(500, __("Email already exists"));
        }
        $user = new \App\Models\User();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->uuid = \App\Utils\Helper::guid(true);
        $user->token = \App\Utils\Helper::guid();
        $user->register_ip = $request->header("CF-Connecting-IP") ?? $request->ip();
        if($request->input("invite_code")) {
            $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_ = \App\Models\InviteCode::where("code", $request->input("invite_code"))->where("status", 0)->first();
            if(!$_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_) {
                if((int) config("aikopanel.invite_force", 0)) {
                    abort(500, __("Invalid invitation code"));
                }
            } else {
                $user->invite_user_id = $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->user_id ? $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->user_id : NULL;
                if(!(int) config("aikopanel.invite_never_expire", 0)) {
                    $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->status = 1;
                    $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->save();
                }
            }
        } else {
            $url = $request->server("HTTP_HOST");
            $_obfuscated_0D1323171736120F08312706041B0533013C123B1A2922_ = parse_url(config("aikopanel.app_url"))["host"] ?? "aikopanel.com";
            if($url !== $_obfuscated_0D1323171736120F08312706041B0533013C123B1A2922_) {
                $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ = \App\Models\User::where("staff_url", $url)->first();
                if($_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_) {
                    $user->invite_user_id = $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->id;
                }
            }
        }
        if((int) config("aikopanel.try_out_plan_id", 0)) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find(config("aikopanel.try_out_plan_id"));
            if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                $user->transfer_enable = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->transfer_enable * 1073741824;
                $user->device_limit = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->device_limit;
                $user->appleid_limit = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->appleid_limit;
                $user->reset_traffic_method = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->reset_traffic_method;
                $user->sni = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->sni;
                $user->plan_id = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id;
                $user->group_id = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->group_id;
                $user->expired_at = time() + config("aikopanel.try_out_hour", 1) * 3600;
                $user->speed_limit = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->speed_limit;
            }
        }
        if(!$user->save()) {
            abort(500, __("Register failed"));
        }
        if((int) config("aikopanel.email_verify", 0)) {
            \Illuminate\Support\Facades\Cache::forget(\App\Utils\CacheKey::get("EMAIL_VERIFY_CODE", $request->input("email")));
        }
        $user->last_login_at = time();
        $user->save();
        if((int) config("aikopanel.register_limit_by_ip_enable", 0)) {
            \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("REGISTER_IP_RATE_LIMIT", $request->ip()), (int) $_obfuscated_0D2B5C5B36172A34175C3C3D0E1A3528313C1737281C32_ + 1, (int) config("aikopanel.register_limit_expire", 60) * 60);
        }
        $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
        return response()->json(["data" => $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->generateAuthData($request)]);
    }
    public function login(\App\Http\Requests\Passport\AuthLogin $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");
        if((int) config("aikopanel.password_limit_enable", 1)) {
            $_obfuscated_0D282E053837311B02181E160D1F370B320C0D28310932_ = (int) \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("PASSWORD_ERROR_LIMIT", $email), 0);
            if((int) config("aikopanel.password_limit_count", 5) <= $_obfuscated_0D282E053837311B02181E160D1F370B320C0D28310932_) {
                abort(500, __("There are too many password errors, please try again after :minute minutes.", ["minute" => config("aikopanel.password_limit_expire", 60)]));
            }
        }
        if(strpos($email, "@") === false) {
            $user = \App\Models\User::where("username", $email)->first();
            if(!$user) {
                abort(500, __("Incorrect email or password"));
            }
            $email = $user->email;
        }
        $user = \App\Models\User::where("email", $email)->first();
        if(!$user) {
            abort(500, __("Incorrect email or password"));
        }
        if(!\App\Utils\Helper::multiPasswordVerify($user->password_algo, $user->password_salt, $password, $user->password)) {
            if((int) config("aikopanel.password_limit_enable")) {
                \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("PASSWORD_ERROR_LIMIT", $email), (int) $_obfuscated_0D282E053837311B02181E160D1F370B320C0D28310932_ + 1, 60 * (int) config("aikopanel.password_limit_expire", 60));
            }
            abort(500, __("Incorrect email or password"));
        }
        $user->last_login_ip = $request->header("CF-Connecting-IP") ?? $request->ip();
        $user->last_login_at = time();
        $user->save();
        if($user->banned) {
            abort(500, __("Your account has been suspended"));
        }
        if((int) config("aikopanel.exchange_enable", 0) === 0 && $user->invite_user_id) {
            $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ = $request->server("HTTP_HOST");
            $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_ = \App\Models\User::find($user->invite_user_id);
            if($_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_) {
                $_obfuscated_0D11111A08032734291F2B27220915372E351C033C0932_ = $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->is_staff && $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->staff_url != $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_;
                if($_obfuscated_0D11111A08032734291F2B27220915372E351C033C0932_) {
                    abort(500, __("You do not have permission to access this site"));
                }
            }
        }
        $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
        return response(["data" => $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->generateAuthData($request)]);
    }
    public function token2Login(\Illuminate\Http\Request $request)
    {
        if($request->input("token")) {
            $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_ = "/#/login?verify=" . $request->input("token") . "&redirect=" . ($request->input("redirect") ? $request->input("redirect") : "dashboard");
            if(config("aikopanel.app_url")) {
                $_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_ = config("aikopanel.app_url") . $_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_;
            } else {
                $_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_ = url($_obfuscated_0D0F320635103C031B5C3E16262C341F0A2E030E2F1811_);
            }
            return redirect()->to($_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_)->send();
        }
        if($request->input("verify")) {
            $key = \App\Utils\CacheKey::get("TEMP_TOKEN", $request->input("verify"));
            $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = \Illuminate\Support\Facades\Cache::get($key);
            if(!$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_) {
                abort(500, __("Token error"));
            }
            $user = \App\Models\User::find($_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_);
            if(!$user) {
                abort(500, __("The user does not "));
            }
            if($user->banned) {
                abort(500, __("Your account has been suspended"));
            }
            \Illuminate\Support\Facades\Cache::forget($key);
            $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_ = new \App\Services\AuthService($user);
            return response(["data" => $_obfuscated_0D1D2914261317340E342F380D1718031F130A0D223822_->generateAuthData($request)]);
        }
    }
    public function getQuickLoginUrl(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_ = $request->input("auth_data") ?? $request->header("authorization");
        if(!$_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_) {
            abort(403, "Không thông minh hoặc đăng nhập vào hết hạn");
        }
        $user = \App\Services\AuthService::decryptAuthData($_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_);
        if(!$user) {
            abort(403, "Không thông minh hoặc đăng nhập vào hết hạn");
        }
        $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ = \App\Utils\Helper::guid();
        $key = \App\Utils\CacheKey::get("TEMP_TOKEN", $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_);
        \Illuminate\Support\Facades\Cache::put($key, $user["id"], 60);
        $redirect = "/#/login?verify=" . $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ . "&redirect=" . ($request->input("redirect") ? $request->input("redirect") : "dashboard");
        if(config("aikopanel.app_url")) {
            $url = config("aikopanel.app_url") . $redirect;
        } else {
            $url = url($redirect);
        }
        return response(["data" => $url]);
    }
    public function forget(\App\Http\Requests\Passport\AuthForget $request)
    {
        $_obfuscated_0D3E0C2F3E3438313F211D1B5C06111A5B1F093D270101_ = \App\Utils\CacheKey::get("FORGET_REQUEST_LIMIT", $request->input("email"));
        $_obfuscated_0D1F3D1E3239032333365B0C011C082F153F34301A1D11_ = (int) \Illuminate\Support\Facades\Cache::get($_obfuscated_0D3E0C2F3E3438313F211D1B5C06111A5B1F093D270101_);
        if(3 <= $_obfuscated_0D1F3D1E3239032333365B0C011C082F153F34301A1D11_) {
            abort(500, __("Reset failed, Please try again later"));
        }
        if((string) \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("EMAIL_VERIFY_CODE", $request->input("email"))) !== (string) $request->input("email_code")) {
            \Illuminate\Support\Facades\Cache::put($_obfuscated_0D3E0C2F3E3438313F211D1B5C06111A5B1F093D270101_, $_obfuscated_0D1F3D1E3239032333365B0C011C082F153F34301A1D11_ ? $_obfuscated_0D1F3D1E3239032333365B0C011C082F153F34301A1D11_ + 1 : 1, 300);
            abort(500, __("Incorrect email verification code"));
        }
        $user = \App\Models\User::where("email", $request->input("email"))->first();
        if(!$user) {
            abort(500, __("This email is not registered in the system"));
        }
        $user->password = password_hash($request->input("password"), PASSWORD_DEFAULT);
        $user->password_algo = NULL;
        $user->password_salt = NULL;
        if(!$user->save()) {
            abort(500, __("Reset failed"));
        }
        \Illuminate\Support\Facades\Cache::forget(\App\Utils\CacheKey::get("EMAIL_VERIFY_CODE", $request->input("email")));
        return response(["data" => true]);
    }
}

?>