<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Middleware;

class License
{
    protected $licenseService;
    public function __construct(\App\Services\LicenseService $licenseService)
    {
        $this->licenseService = $licenseService;
    }
    public function handle(\Illuminate\Http\Request $request, \Closure $next)
    {
        return  $next($request);
    }
}

?>