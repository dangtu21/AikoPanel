<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V2;

class StaffRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel")), "middleware" => ["staff", "log"]], function ($router) {
            $router->get("/stat/override", "V2\\Staff\\StatController@override");
            $router->get("/stat/record", "V2\\Staff\\StatController@record");
            $router->get("/stat/ranking", "V2\\Staff\\StatController@ranking");
        });
    }
}

?>