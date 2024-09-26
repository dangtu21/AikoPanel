<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class StaffRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel")), "middleware" => ["staff", "log"]], function ($router) {
            $currentHost = request()->getHost();
            $mainHost = parse_url(config("aikopanel.app_url"), PHP_URL_HOST);
            $currentPath = request()->getPathInfo();
            $staffPath = config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel"));
            if($currentHost == config("aikopanel.app_url") && $currentPath == "/" . $staffPath) {
                return redirect("/");
            }
            $router->get("/config/fetch", "V1\\Staff\\ConfigController@fetch");
            $router->post("/config/save", "V1\\Staff\\ConfigController@save");
            $router->post("/config/setTelegramWebhook", "V1\\Staff\\ConfigController@setTelegramWebhook");
            $router->get("/plan/fetch", "V1\\Staff\\PlanController@fetch");
            $router->post("/plan/sort", "V1\\Staff\\PlanController@sort");
            $router->get("/server/group/fetch", "V1\\Staff\\Server\\GroupController@fetch");
            $router->get("/server/manage/getNodes", "V1\\Staff\\Server\\ManageController@getNodes");
            $router->get("/order/fetch", "V1\\Staff\\OrderController@fetch");
            $router->post("/order/assign", "V1\\Staff\\OrderController@assign");
            $router->post("/order/detail", "V1\\Staff\\OrderController@detail");
            $router->get("/user/fetch", "V1\\Staff\\UserController@fetch");
            $router->post("/user/update", "V1\\Staff\\UserController@update");
            $router->get("/user/getUserInfoById", "V1\\Staff\\UserController@getUserInfoById");
            $router->post("/user/generate", "V1\\Staff\\UserController@generate");
            $router->post("/user/dumpCSV", "V1\\Staff\\UserController@dumpCSV");
            $router->post("/user/sendMail", "V1\\Staff\\UserController@sendMail");
            $router->post("/user/ban", "V1\\Staff\\UserController@ban");
            $router->post("/user/resetSecret", "V1\\Staff\\UserController@resetSecret");
            $router->post("/user/delUser", "V1\\Staff\\UserController@delUser");
            $router->post("/user/setInviteUser", "V1\\Staff\\UserController@setInviteUser");
            $router->get("/stat/getStat", "V1\\Staff\\StatController@getStat");
            $router->get("/stat/InfoStaff", "V1\\Staff\\StatController@InfoStaff");
            $router->get("/stat/getServerLastRank", "V1\\Staff\\StatController@getServerLastRank");
            $router->get("/stat/getServerTodayRank", "V1\\Staff\\StatController@getServerTodayRank");
            $router->get("/stat/getUserLastRank", "V1\\Staff\\StatController@getUserLastRank");
            $router->get("/stat/getUserTodayRank", "V1\\Staff\\StatController@getUserTodayRank");
            $router->get("/stat/getStatUser", "V1\\Staff\\StatController@getStatUser");
            $router->get("/stat/getRanking", "V1\\Staff\\StatController@getRanking");
            $router->get("/stat/getStatRecord", "V1\\Staff\\StatController@getStatRecord");
        });
    }
}

?>