<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class ClientRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => "client", "middleware" => ["client", "license", "ruleblock"]], function ($router) {
            $router->get("/subscribe", "V1\\Client\\ClientController@subscribe");
        });
    }
}

?>