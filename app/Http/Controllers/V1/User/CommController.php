<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class CommController extends \App\Http\Controllers\Controller
{
    public function config(\Illuminate\Http\Request $request)
    {
        $config = ["aikopanel" => config("aikopanel.app_url"), "is_telegram" => (int) config("aikopanel.telegram_bot_enable", 0), "telegram_discuss_link" => config("aikopanel.telegram_discuss_link"), "zalo_discuss_link" => config("aikopanel.zalo_discuss_link"), "stripe_pk" => config("aikopanel.stripe_pk_live"), "withdraw_methods" => config("aikopanel.commission_withdraw_method", \App\Utils\Dict::WITHDRAW_METHOD_WHITELIST_DEFAULT), "withdraw_close" => (int) config("aikopanel.withdraw_close_enable", 0), "currency" => config("aikopanel.currency", "VND"), "currency_symbol" => config("aikopanel.currency_symbol", "₫"), "naptien_on" => (int) config("aikopanel.naptien_on", 0), "min_recharge_amount" => (int) config("aikopanel.min_recharge_amount", 1000), "max_recharge_amount" => (int) config("aikopanel.max_recharge_amount", 100000), "commission_distribution_enable" => (int) config("aikopanel.commission_distribution_enable", 0), "commission_distribution_l1" => config("aikopanel.commission_distribution_l1"), "commission_distribution_l2" => config("aikopanel.commission_distribution_l2"), "commission_distribution_l3" => config("aikopanel.commission_distribution_l3"), "show_total_user_enable" => (int) config("aikopanel.show_total_user_enable", 0), "app_windows_enable" => (int) config("aikopanel.app_windows_enable", 1), "app_macos_enable" => (int) config("aikopanel.app_macos_enable", 1), "app_ios_enable" => (int) config("aikopanel.app_ios_enable", 1), "app_android_enable" => (int) config("aikopanel.app_android_enable", 1)];
        $_obfuscated_0D153E0936330E262A07150F23340A3815120E5C0D2532_ = \App\Models\Sni::where("show", 1)->get();
        $config["sni"] = $_obfuscated_0D153E0936330E262A07150F23340A3815120E5C0D2532_->map(function ($item) {
            return ["value" => $item->value, "lable" => $item->label, "abbreviation" => $item->abbreviation, "content" => $item->content];
        })->toArray();
        $url = $request->getHost();
        $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_ = parse_url(config("aikopanel.app_url"), PHP_URL_HOST);
        if($url === $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_) {
            $config = array_merge($config, ["collaborator_enable" => (int) config("aikopanel.collaborator_enable", 0), "cloudflare_ns_1" => config("aikopanel.cloudflare_ns_1"), "cloudflare_ns_2" => config("aikopanel.cloudflare_ns_2")]);
        }
        if(config("aikopanel.appleid_custom_url") === NULL && config("aikopanel.appleid_api") === NULL) {
            $config["appleid_custom_url"] = "/appleid";
        } else {
            $config["appleid_custom_url"] = config("aikopanel.appleid_custom_url");
        }
        return response(["data" => $config]);
    }
    public function getStripePublicKey(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_ = \App\Models\Payment::where("id", $request->input("id"))->where("payment", "StripeCredit")->first();
        if(!$_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_) {
            abort(500, "payment is not found");
        }
        return response(["data" => $_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_->config["stripe_pk_live"]]);
    }
}

?>