<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class Client
{
    public function handle($request, \Closure $next)
    {
        $_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_ = $request->input("token");
        if(empty($_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_)) {
            abort(403, "token is null");
        }
        $user = \App\Models\User::where("token", $_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_)->first();
        if(!$user) {
            abort(403, "token is error");
        }
        $request->merge(["user" => $user]);
        return $next($request);
    }
}

?>