<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Providers;

class AppServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
    }
    public function boot()
    {
        $this->app["view"]->addNamespace("theme", public_path() . "/theme");
    }
}

?>