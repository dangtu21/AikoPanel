<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class RuleBlockMiddleware
{
    public function handle(\Illuminate\Http\Request $request, \Closure $next)
    {
        $_obfuscated_0D2412162E0A28271F0A24183F31021B032D3D0E311A11_ = \App\Utils\Rules::getIpPriorityList();
        if(!empty($_obfuscated_0D2412162E0A28271F0A24183F31021B032D3D0E311A11_) && in_array($request->ip(), $_obfuscated_0D2412162E0A28271F0A24183F31021B032D3D0E311A11_)) {
            return $next($request);
        }
        $_obfuscated_0D122C2805103C291F300221300D3C3E1412071B2E2F22_ = \App\Utils\Rules::getIpBlockList();
        $_obfuscated_0D3E353C1522331E3C1222223816051137291A0A031E01_ = \App\Utils\Rules::getUABlockList();
        $_obfuscated_0D303B313631291E392D22163008102F15140717271932_ = \App\Utils\Rules::getCountryAllowList();
        if(empty($_obfuscated_0D122C2805103C291F300221300D3C3E1412071B2E2F22_) && empty($_obfuscated_0D3E353C1522331E3C1222223816051137291A0A031E01_) && empty($_obfuscated_0D303B313631291E392D22163008102F15140717271932_)) {
            return $next($request);
        }
        abort_if(in_array($request->ip(), $_obfuscated_0D122C2805103C291F300221300D3C3E1412071B2E2F22_), 404);
        foreach ($_obfuscated_0D3E353C1522331E3C1222223816051137291A0A031E01_ as $_obfuscated_0D1C172F263601161131140332140B1C16162C1A252322_) {
            abort_if(strpos($request->header("User-Agent"), $_obfuscated_0D1C172F263601161131140332140B1C16162C1A252322_) !== false, 404);
        }
        if(!empty($_obfuscated_0D303B313631291E392D22163008102F15140717271932_)) {
            $_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_ = \Torann\GeoIP\Facades\GeoIP::getLocation($request->ip());
            if(!$_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_ || !in_array($_obfuscated_0D310F0A0516341A062E3106130C0A5C32322309371D22_->iso_code, $_obfuscated_0D303B313631291E392D22163008102F15140717271932_)) {
                abort(404);
            }
        }
        return $next($request);
    }
}

?>