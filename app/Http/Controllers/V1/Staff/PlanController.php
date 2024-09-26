<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff;

class PlanController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->user["id"]);
        $_obfuscated_0D30240E3C093C1E31400A2E26071C3D0A3F2638211D22_ = parse_url($user->staff_url, PHP_URL_HOST);
        $_obfuscated_0D371F071E1F151A032A13355C1A141A031C2725391A11_ = $request->server("HTTP_HOST");
        $_obfuscated_0D283D1C0B1436343B282301112615250A1E061B5B3111_ = parse_url(config("aikopanel.app_url"), PHP_URL_HOST);
        $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_ = \App\Models\Plan::where("show", 1)->orderBy("sort", "ASC")->get();
        $_obfuscated_0D0628033F0B1A3E031E341239322832241D0635070A22_ = $_obfuscated_0D33051C23112B0819113F3D3D36043F24351E40321F22_->filter(function ($plan) use($plan) {
            $plan->count = 0;
            $plan->total = \App\Models\User::where("plan_id", $plan->id)->where("invite_user_id", $user->id)->count();
            $staffDomains = array_map(function ($url) {
                return parse_url($url, PHP_URL_HOST);
            }, $plan->plan_of_staff ?? []);
            if($plan->plan_type === 1) {
                return false;
            }
            if($plan->plan_type === 2) {
                if(empty($staffDomains)) {
                    return $currentUrl !== $mainUrl && $userStaffHostname !== $mainUrl;
                }
                return in_array($userStaffHostname, $staffDomains);
            }
            if($plan->plan_type === 3 && !empty($staffDomains)) {
                return in_array($userStaffHostname, $staffDomains);
            }
            return true;
        })->values();
        return response(["data" => $_obfuscated_0D0628033F0B1A3E031E341239322832241D0635070A22_]);
    }
    public function sort(\App\Http\Requests\Staff\PlanSort $request)
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