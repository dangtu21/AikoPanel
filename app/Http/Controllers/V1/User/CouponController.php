<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class CouponController extends \App\Http\Controllers\Controller
{
    public function check(\Illuminate\Http\Request $request)
    {
        if(!$request->input("code")) {
            abort(500, __("Coupon cannot be empty"));
        }
        $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_ = new \App\Services\CouponService($request->input("code"));
        $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->setPlanId($request->input("plan_id"));
        $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->setUserId($request->user["id"]);
        $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->check();
        return response(["data" => $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->getCoupon()]);
    }
}

?>