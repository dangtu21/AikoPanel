<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class UserRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => "user", "middleware" => "user"], function ($router) {
            $router->get("/resetSecurity", "V1\\User\\UserController@resetSecurity");
            $router->get("/info", "V1\\User\\UserController@info");
            $router->get("/applications", "V1\\User\\UserController@Applications");
            $router->post("/changePassword", "V1\\User\\UserController@changePassword");
            $router->post("/changeSNI", "V1\\User\\UserController@changeSNI");
            $router->post("/changeAvatar", "V1\\User\\UserController@changeAvatar");
            $router->post("/changeUserName", "V1\\User\\UserController@changeUserName");
            $router->post("/update", "V1\\User\\UserController@update");
            $router->get("/getSubscribe", "V1\\User\\UserController@getSubscribe");
            $router->get("/getStat", "V1\\User\\UserController@getStat");
            $router->get("/checkLogin", "V1\\User\\UserController@checkLogin");
            $router->post("/transfer", "V1\\User\\UserController@transfer");
            $router->post("/getQuickLoginUrl", "V1\\User\\UserController@getQuickLoginUrl");
            $router->get("/getActiveSession", "V1\\User\\UserController@getActiveSession");
            $router->post("/removeActiveSession", "V1\\User\\UserController@removeActiveSession");
            $router->post("/order/save", "V1\\User\\OrderController@save");
            $router->post("/order/reCharge", "V1\\User\\OrderController@reCharge");
            $router->post("/order/checkout", "V1\\User\\OrderController@checkout");
            $router->get("/order/check", "V1\\User\\OrderController@check");
            $router->get("/order/detail", "V1\\User\\OrderController@detail");
            $router->get("/order/fetch", "V1\\User\\OrderController@fetch");
            $router->get("/order/getPaymentMethod", "V1\\User\\OrderController@getPaymentMethod");
            $router->post("/order/cancel", "V1\\User\\OrderController@cancel");
            $router->get("/plan/fetch", "V1\\User\\PlanController@fetch");
            $router->get("/invite/save", "V1\\User\\InviteController@save");
            $router->get("/invite/fetch", "V1\\User\\InviteController@fetch");
            $router->get("/invite/details", "V1\\User\\InviteController@details");
            $router->get("/notice/fetch", "V1\\User\\NoticeController@fetch");
            $router->post("/ticket/reply", "V1\\User\\TicketController@reply");
            $router->post("/ticket/close", "V1\\User\\TicketController@close");
            $router->post("/ticket/save", "V1\\User\\TicketController@save");
            $router->get("/ticket/fetch", "V1\\User\\TicketController@fetch");
            $router->post("/ticket/withdraw", "V1\\User\\TicketController@withdraw");
            $router->get("/server/fetch", "V1\\User\\ServerController@fetch");
            $router->post("/coupon/check", "V1\\User\\CouponController@check");
            $router->get("/telegram/getBotInfo", "V1\\User\\TelegramController@getBotInfo");
            $router->get("/comm/config", "V1\\User\\CommController@config");
            $router->Post("/comm/getStripePublicKey", "V1\\User\\CommController@getStripePublicKey");
            $router->get("/knowledge/fetch", "V1\\User\\KnowledgeController@fetch");
            $router->get("/knowledge/getCategory", "V1\\User\\KnowledgeController@getCategory");
            $router->get("/stat/getTrafficLog", "V1\\User\\StatController@getTrafficLog");
        });
    }
}

?>