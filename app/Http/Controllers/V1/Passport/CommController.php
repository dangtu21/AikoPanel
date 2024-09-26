<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Passport;

class CommController extends \App\Http\Controllers\Controller
{
    private function isEmailVerify()
    {
        return response(["data" => (int) config("aikopanel.email_verify", 0) ? 1 : 0]);
    }
    public function sendEmailVerify(\App\Http\Requests\Passport\CommSendEmailVerify $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if((int) config("aikopanel.recaptcha_enable", 0)) {
            $_obfuscated_0D361301250C361C04262A0E3E0F24271733260A212411_ = new \ReCaptcha\ReCaptcha(config("aikopanel.recaptcha_key"));
            $_obfuscated_0D1C2237051E0A3F1E1530372D5C02371E123923292622_ = $_obfuscated_0D361301250C361C04262A0E3E0F24271733260A212411_->verify($request->input("recaptcha_data"));
            if(!$_obfuscated_0D1C2237051E0A3F1E1530372D5C02371E123923292622_->isSuccess()) {
                abort(500, __("Invalid code is incorrect"));
            }
        }
        $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_ = $request->input("email");
        if(\Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("LAST_SEND_EMAIL_VERIFY_TIMESTAMP", $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_))) {
            abort(500, __("Email verification code has been sent, please request again later"));
        }
        $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_ = rand(100000, 999999);
        $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_ = config("aikopanel.app_name", "AikoPanel") . __("Email verification code");
        \App\Jobs\SendEmailJob::dispatch(["email" => $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_, "subject" => $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_, "template_name" => "verify", "template_value" => ["name" => config("aikopanel.app_name", "AikoPanel"), "code" => $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_, "url" => config("aikopanel.app_url")]]);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("EMAIL_VERIFY_CODE", $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_), $_obfuscated_0D292A345C1B1C102106291B38103F301B5C043B2B2F11_, 300);
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("LAST_SEND_EMAIL_VERIFY_TIMESTAMP", $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_), time(), 60);
        return response(["data" => true]);
    }
    public function pv(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_ = \App\Models\InviteCode::where("code", $request->input("invite_code"))->first();
        if($_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_) {
            $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->pv = $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->pv + 1;
            $_obfuscated_0D1C09300A08340B34242D3F281A221D391A3F33333301_->save();
        }
        return response(["data" => true]);
    }
    private function getEmailSuffix()
    {
        $_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_ = config("aikopanel.email_whitelist_suffix", \App\Utils\Dict::EMAIL_WHITELIST_SUFFIX_DEFAULT);
        if(!is_array($_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_)) {
            return preg_split("/,/", $_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_);
        }
        return $_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_;
    }
}

?>