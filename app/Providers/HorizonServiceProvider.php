<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Providers;

class HorizonServiceProvider extends \Laravel\Horizon\HorizonApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }
    protected function gate()
    {
        \Illuminate\Support\Facades\Gate::define("viewHorizon", function ($user) {
            return in_array($user->email, []);
        });
    }
}

?>