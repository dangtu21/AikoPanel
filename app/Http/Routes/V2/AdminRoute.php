<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V2;

class AdminRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => config("aikopanel.secure_path", config("aikopanel.frontend_admin_path", "aikopanel")), "middleware" => ["admin", "log"]], function ($router) {
            $router->get("/stat/override", "V2\\Admin\\StatController@override");
            $router->get("/stat/record", "V2\\Admin\\StatController@record");
            $router->get("/stat/ranking", "V2\\Admin\\StatController@ranking");
        });
    }
}

?>