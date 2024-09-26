<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Guest;

class CommController extends \App\Http\Controllers\Controller
{
    public function config()
    {
        return response(["data" => ["tos_url" => config("aikopanel.tos_url"), "is_email_verify" => (int) config("aikopanel.email_verify", 0) ? 1 : 0, "is_invite_force" => (int) config("aikopanel.invite_force", 0) ? 1 : 0, "email_whitelist_suffix" => (int) config("aikopanel.email_whitelist_enable", 0) ? $this->getEmailSuffix() : 0, "is_recaptcha" => (int) config("aikopanel.recaptcha_enable", 0) ? 1 : 0, "recaptcha_site_key" => config("aikopanel.recaptcha_site_key"), "app_description" => config("aikopanel.app_description"), "app_url" => config("aikopanel.app_url"), "logo" => config("aikopanel.logo")]]);
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