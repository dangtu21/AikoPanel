<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class PassportRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => "passport"], function ($router) {
            $router->post("/auth/register", "V1\\Passport\\AuthController@register");
            $router->post("/auth/login", "V1\\Passport\\AuthController@login");
            $router->get("/auth/token2Login", "V1\\Passport\\AuthController@token2Login");
            $router->post("/auth/forget", "V1\\Passport\\AuthController@forget");
            $router->post("/auth/getQuickLoginUrl", "V1\\Passport\\AuthController@getQuickLoginUrl");
            $router->post("/auth/loginWithMailLink", "V1\\Passport\\AuthController@loginWithMailLink");
            $router->post("/comm/sendEmailVerify", "V1\\Passport\\CommController@sendEmailVerify");
            $router->post("/comm/pv", "V1\\Passport\\CommController@pv");
        });
    }
}

?>