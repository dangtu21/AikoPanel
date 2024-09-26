<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class CORS
{
    public function handle($request, \Closure $next)
    {
        $_obfuscated_0D1D213C0F303D1D185B013C2A032E1B250A0B13020D22_ = $request->header("origin");
        if(empty($_obfuscated_0D1D213C0F303D1D185B013C2A032E1B250A0B13020D22_)) {
            $_obfuscated_0D042A310526153C150A0B213F14050511070838272122_ = $request->header("referer");
            if(!empty($_obfuscated_0D042A310526153C150A0B213F14050511070838272122_) && preg_match("/^((https|http):\\/\\/)?([^\\/]+)/i", $_obfuscated_0D042A310526153C150A0B213F14050511070838272122_, $_obfuscated_0D303639222B5C5B22211E2A28033003281C5C341D1622_)) {
                $_obfuscated_0D1D213C0F303D1D185B013C2A032E1B250A0B13020D22_ = $_obfuscated_0D303639222B5C5B22211E2A28033003281C5C341D1622_[0];
            }
        }
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $next($request);
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->header("Access-Control-Allow-Origin", trim($_obfuscated_0D1D213C0F303D1D185B013C2A032E1B250A0B13020D22_, "/"));
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->header("Access-Control-Allow-Methods", "GET,POST,OPTIONS,HEAD");
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->header("Access-Control-Allow-Headers", "Origin,Content-Type,Accept,Authorization,X-Request-With");
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->header("Access-Control-Allow-Credentials", "true");
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->header("Access-Control-Max-Age", 10080);
        return $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_;
    }
}

?>