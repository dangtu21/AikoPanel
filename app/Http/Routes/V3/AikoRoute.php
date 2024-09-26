<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V3;

class AikoRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => "Aiko", "middleware" => "license"], function ($router) {
            $router->any("/{class}/{action}", function ($class, $action) {
                $ctrl = \App::make("\\App\\Http\\Controllers\\V3\\Aiko\\" . ucfirst($class) . "Controller");
                return \App::call([$ctrl, $action]);
            });
        });
    }
}

?>