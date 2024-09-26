<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class RequestLog
{
    public function handle($request, \Closure $next)
    {
        if($request->method() === "POST") {
            $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = $request->path();
            info("POST " . $path);
        }
        return $next($request);
    }
}

?>