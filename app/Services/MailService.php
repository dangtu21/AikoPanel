<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class MailService
{
    public function remindTraffic(\App\Models\User $user)
    {
        if(!$user->remind_traffic) {
            return NULL;
        }
        if(!$this->remindTrafficIsWarnValue($user->u, $user->d, $user->transfer_enable)) {
            return NULL;
        }
        $flag = \App\Utils\CacheKey::get("LAST_SEND_EMAIL_REMIND_TRAFFIC", $user->id);
        if(\Illuminate\Support\Facades\Cache::get($flag)) {
            return NULL;
        }
        if(!\Illuminate\Support\Facades\Cache::put($flag, 1, 86400)) {
            return NULL;
        }
        \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => __("The traffic usage in :app_name has reached 80%", ["app_name" => \App\Utils\Helper::getAppNameById($user->id)]), "template_name" => "remindTraffic", "template_value" => ["name" => \App\Utils\Helper::getAppNameById($user->id), "url" => config("aikopanel.app_url")]]);
    }
    public function remindExpire(\App\Models\User $user)
    {
        if(!($user->expired_at !== NULL && $user->expired_at - 86400 < time() && time() < $user->expired_at)) {
            return NULL;
        }
        \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => __("The service in :app_name is about to expire", ["app_name" => \App\Utils\Helper::getAppNameById($user->id)]), "template_name" => "remindExpire", "template_value" => ["name" => \App\Utils\Helper::getAppNameById($user->id), "url" => config("aikopanel.app_url")]]);
    }
    private function remindTrafficIsWarnValue($u, $d, $transfer_enable)
    {
        $_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_ = $u + $d;
        if(!$_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_) {
            return false;
        }
        if(!$transfer_enable) {
            return false;
        }
        $_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_ = $_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_ / $transfer_enable * 100;
        if($_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_ < 80) {
            return false;
        }
        if(100 <= $_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_) {
            return false;
        }
        return true;
    }
    public function paymentNotifyToUser(\App\Models\Order $order, \App\Models\User $user)
    {
        $_obfuscated_0D2E183B322C1C2A2B22133005390935373B5B34252511_ = sprintf("✨ Cảm ơn bạn đã thanh toán %s VNĐ, đơn hàng sẽ được xử lý từ 1-3 phút.\n———————————————\nMã đơn hàng: %s", number_format($order->total_amount / 100, 0, ".", ","), $order->trade_no);
        $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_ = \App\Utils\Helper::getAppNameById($user->id) . " - Thông báo thanh toán thành công";
        \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_, "template_name" => "notify", "template_value" => ["name" => \App\Utils\Helper::getAppNameById($user->id), "url" => config("aikopanel.app_url"), "content" => $_obfuscated_0D2E183B322C1C2A2B22133005390935373B5B34252511_]]);
    }
}

?>