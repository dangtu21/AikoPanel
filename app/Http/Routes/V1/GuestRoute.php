<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class GuestRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => "guest"], function ($router) {
            $router->post("/telegram/webhook", "V1\\Guest\\TelegramController@webhook");
            $router->match(["get", "post"], "/payment/notify/{method}/{uuid}", "V1\\Guest\\PaymentController@notify");
            $router->get("/comm/config", "V1\\Guest\\CommController@config");
        });
    }
}

?>