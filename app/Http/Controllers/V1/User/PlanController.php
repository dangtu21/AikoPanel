<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class PlanController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D371F071E1F151A032A13355C1A141A031C2725391A11_ = $request->server("HTTP_HOST");
        $_obfuscated_0D283D1C0B1436343B282301112615250A1E061B5B3111_ = parse_url(config("aikopanel.app_url"), PHP_URL_HOST);
        $user = \App\Models\User::find($request->user["id"]);
        if($request->input("id")) {
            $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("id"));
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                abort(500, __("Subscription plan does not exist"));
            }
            if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->show && !$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->renew || !$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->show && $user->plan_id !== $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id) {
                abort(500, __("Subscription plan does not exist"));
            }
            return response(["data" => $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_]);
        }
        $_obfuscated_0D2F011309323E013F0A2A0B22380D343202232F070222_ = \App\Services\PlanService::countActiveUsers();
        $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ = \App\Models\Plan::where("show", 1)->orderBy("sort", "ASC")->get();
        $_obfuscated_0D0628033F0B1A3E031E341239322832241D0635070A22_ = $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_->filter(function ($plan) use($plan) {
            $plan->count = 0;
            $plan->total = \App\Models\User::where("plan_id", $plan->id)->count();
            foreach ($counts as $count) {
                if($plan->id === $count->plan_id) {
                    $plan->count = $count->count;
                }
            }
            if($plan->capacity_limit !== NULL && isset($counts[$plan->id])) {
                $plan->capacity_limit -= $counts[$plan->id]->count;
            }
            $staffIds = $plan->plan_of_staff ?? [];
            $staffDomains = \App\Models\User::whereIn("id", $staffIds)->pluck("staff_url")->toArray();
            if($plan->plan_type === 1 && $currentUrl !== $mainUrl) {
                return false;
            }
            if($plan->plan_type === 2) {
                if(empty($staffDomains)) {
                    return $currentUrl !== $mainUrl;
                }
                return in_array($currentUrl, $staffDomains);
            }
            if($plan->plan_type === 3 && !empty($staffDomains)) {
                return in_array($currentUrl, $staffDomains) || $currentUrl === $mainUrl;
            }
            return true;
        })->values();
        return response(["data" => $_obfuscated_0D0628033F0B1A3E031E341239322832241D0635070A22_]);
    }
}

?>