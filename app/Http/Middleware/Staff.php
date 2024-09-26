<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class Staff
{
    public function handle($request, \Closure $next)
    {
        $_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_ = $request->input("auth_data") ?? $request->header("authorization");
        if(!$_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_) {
            abort(403, "Chưa đăng nhập hoặc phiên đăng nhập đã hết hạn");
        }
        $user = \App\Services\AuthService::decryptAuthData($_obfuscated_0D391B3E0B3E15041E252E0B13223B3D013C363C1B1811_);
        if(!$user || !$user["is_staff"]) {
            abort(403, "Chưa đăng nhập hoặc phiên đăng nhập đã hết hạn");
        }
        $request->merge(["user" => $user]);
        return $next($request);
    }
}

?>