<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Routes\V1;

class AdminRoute
{
    public function map(\Illuminate\Contracts\Routing\Registrar $router)
    {
        $router->group(["prefix" => config("aikopanel.secure_path", config("aikopanel.frontend_admin_path", "aikopanel")), "middleware" => ["admin", "log"]], function ($router) {
            $router->get("/config/fetch", "V1\\Admin\\ConfigController@fetch");
            $router->post("/config/save", "V1\\Admin\\ConfigController@save");
            $router->get("/config/getEmailTemplate", "V1\\Admin\\ConfigController@getEmailTemplate");
            $router->get("/config/getThemeTemplate", "V1\\Admin\\ConfigController@getThemeTemplate");
            $router->post("/config/setTelegramWebhook", "V1\\Admin\\ConfigController@setTelegramWebhook");
            $router->post("/config/testSendMail", "V1\\Admin\\ConfigController@testSendMail");
            $router->post("/config/backupDataBase", "V1\\Admin\\ConfigController@backupDataBase");
            $router->get("/plan/fetch", "V1\\Admin\\PlanController@fetch");
            $router->post("/plan/save", "V1\\Admin\\PlanController@save");
            $router->post("/plan/drop", "V1\\Admin\\PlanController@drop");
            $router->post("/plan/update", "V1\\Admin\\PlanController@update");
            $router->post("/plan/sort", "V1\\Admin\\PlanController@sort");
            $router->get("/server/group/fetch", "V1\\Admin\\Server\\GroupController@fetch");
            $router->post("/server/group/save", "V1\\Admin\\Server\\GroupController@save");
            $router->post("/server/group/drop", "V1\\Admin\\Server\\GroupController@drop");
            $router->get("/server/route/fetch", "V1\\Admin\\Server\\RouteController@fetch");
            $router->post("/server/route/save", "V1\\Admin\\Server\\RouteController@save");
            $router->post("/server/route/drop", "V1\\Admin\\Server\\RouteController@drop");
            $router->get("/server/manage/getNodes", "V1\\Admin\\Server\\ManageController@getNodes");
            $router->post("/server/manage/sort", "V1\\Admin\\Server\\ManageController@sort");
            $router->group(["prefix" => "server/trojan"], function ($router) {
                $router->post("save", "V1\\Admin\\Server\\TrojanController@save");
                $router->post("drop", "V1\\Admin\\Server\\TrojanController@drop");
                $router->post("update", "V1\\Admin\\Server\\TrojanController@update");
                $router->post("copy", "V1\\Admin\\Server\\TrojanController@copy");
            });
            $router->group(["prefix" => "server/vmess"], function ($router) {
                $router->post("save", "V1\\Admin\\Server\\VmessController@save");
                $router->post("drop", "V1\\Admin\\Server\\VmessController@drop");
                $router->post("update", "V1\\Admin\\Server\\VmessController@update");
                $router->post("copy", "V1\\Admin\\Server\\VmessController@copy");
            });
            $router->group(["prefix" => "server/shadowsocks"], function ($router) {
                $router->post("save", "V1\\Admin\\Server\\ShadowsocksController@save");
                $router->post("drop", "V1\\Admin\\Server\\ShadowsocksController@drop");
                $router->post("update", "V1\\Admin\\Server\\ShadowsocksController@update");
                $router->post("copy", "V1\\Admin\\Server\\ShadowsocksController@copy");
            });
            $router->group(["prefix" => "server/hysteria"], function ($router) {
                $router->post("save", "V1\\Admin\\Server\\HysteriaController@save");
                $router->post("drop", "V1\\Admin\\Server\\HysteriaController@drop");
                $router->post("update", "V1\\Admin\\Server\\HysteriaController@update");
                $router->post("copy", "V1\\Admin\\Server\\HysteriaController@copy");
            });
            $router->group(["prefix" => "server/vless"], function ($router) {
                $router->post("save", "V1\\Admin\\Server\\VlessController@save");
                $router->post("drop", "V1\\Admin\\Server\\VlessController@drop");
                $router->post("update", "V1\\Admin\\Server\\VlessController@update");
                $router->post("copy", "V1\\Admin\\Server\\VlessController@copy");
            });
            $router->get("/order/fetch", "V1\\Admin\\OrderController@fetch");
            $router->post("/order/update", "V1\\Admin\\OrderController@update");
            $router->post("/order/assign", "V1\\Admin\\OrderController@assign");
            $router->post("/order/paid", "V1\\Admin\\OrderController@paid");
            $router->post("/order/cancel", "V1\\Admin\\OrderController@cancel");
            $router->post("/order/detail", "V1\\Admin\\OrderController@detail");
            $router->get("/user/fetch", "V1\\Admin\\UserController@fetch");
            $router->post("/user/update", "V1\\Admin\\UserController@update");
            $router->get("/user/getUserInfoById", "V1\\Admin\\UserController@getUserInfoById");
            $router->post("/user/generate", "V1\\Admin\\UserController@generate");
            $router->post("/user/dumpCSV", "V1\\Admin\\UserController@dumpCSV");
            $router->post("/user/sendMail", "V1\\Admin\\UserController@sendMail");
            $router->post("/user/ban", "V1\\Admin\\UserController@ban");
            $router->post("/user/resetSecret", "V1\\Admin\\UserController@resetSecret");
            $router->post("/user/delUser", "V1\\Admin\\UserController@delUser");
            $router->post("/user/setInviteUser", "V1\\Admin\\UserController@setInviteUser");
            $router->get("/stat/getStat", "V1\\Admin\\StatController@getStat");
            $router->get("/stat/getOverride", "V1\\Admin\\StatController@getOverride");
            $router->get("/stat/getServerLastRank", "V1\\Admin\\StatController@getServerLastRank");
            $router->get("/stat/getServerTodayRank", "V1\\Admin\\StatController@getServerTodayRank");
            $router->get("/stat/getUserLastRank", "V1\\Admin\\StatController@getUserLastRank");
            $router->get("/stat/getUserTodayRank", "V1\\Admin\\StatController@getUserTodayRank");
            $router->get("/stat/getOrder", "V1\\Admin\\StatController@getOrder");
            $router->get("/stat/getStatUser", "V1\\Admin\\StatController@getStatUser");
            $router->get("/stat/getRanking", "V1\\Admin\\StatController@getRanking");
            $router->get("/stat/getStatRecord", "V1\\Admin\\StatController@getStatRecord");
            $router->get("/notice/fetch", "V1\\Admin\\NoticeController@fetch");
            $router->post("/notice/save", "V1\\Admin\\NoticeController@save");
            $router->post("/notice/update", "V1\\Admin\\NoticeController@update");
            $router->post("/notice/drop", "V1\\Admin\\NoticeController@drop");
            $router->post("/notice/show", "V1\\Admin\\NoticeController@show");
            $router->get("/sni/fetch", "V1\\Admin\\SniController@fetch");
            $router->post("/sni/save", "V1\\Admin\\SniController@save");
            $router->post("/sni/update", "V1\\Admin\\SniController@update");
            $router->post("/sni/drop", "V1\\Admin\\SniController@drop");
            $router->post("/sni/show", "V1\\Admin\\SniController@show");
            $router->get("/ticket/fetch", "V1\\Admin\\TicketController@fetch");
            $router->post("/ticket/reply", "V1\\Admin\\TicketController@reply");
            $router->post("/ticket/close", "V1\\Admin\\TicketController@close");
            $router->get("/coupon/fetch", "V1\\Admin\\CouponController@fetch");
            $router->post("/coupon/generate", "V1\\Admin\\CouponController@generate");
            $router->post("/coupon/drop", "V1\\Admin\\CouponController@drop");
            $router->post("/coupon/show", "V1\\Admin\\CouponController@show");
            $router->get("/knowledge/fetch", "V1\\Admin\\KnowledgeController@fetch");
            $router->get("/knowledge/getCategory", "V1\\Admin\\KnowledgeController@getCategory");
            $router->post("/knowledge/save", "V1\\Admin\\KnowledgeController@save");
            $router->post("/knowledge/show", "V1\\Admin\\KnowledgeController@show");
            $router->post("/knowledge/drop", "V1\\Admin\\KnowledgeController@drop");
            $router->post("/knowledge/sort", "V1\\Admin\\KnowledgeController@sort");
            $router->get("/payment/fetch", "V1\\Admin\\PaymentController@fetch");
            $router->get("/payment/getPaymentMethods", "V1\\Admin\\PaymentController@getPaymentMethods");
            $router->post("/payment/getPaymentForm", "V1\\Admin\\PaymentController@getPaymentForm");
            $router->post("/payment/save", "V1\\Admin\\PaymentController@save");
            $router->post("/payment/drop", "V1\\Admin\\PaymentController@drop");
            $router->post("/payment/show", "V1\\Admin\\PaymentController@show");
            $router->post("/payment/sort", "V1\\Admin\\PaymentController@sort");
            $router->get("/system/getSystemStatus", "V1\\Admin\\SystemController@getSystemStatus");
            $router->get("/system/getQueueStats", "V1\\Admin\\SystemController@getQueueStats");
            $router->get("/system/getQueueWorkload", "V1\\Admin\\SystemController@getQueueWorkload");
            $router->get("/system/getQueueMasters", "\\Laravel\\Horizon\\Http\\Controllers\\MasterSupervisorController@index");
            $router->get("/system/getSystemLog", "V1\\Admin\\SystemController@getSystemLog");
            $router->get("/theme/getThemes", "V1\\Admin\\ThemeController@getThemes");
            $router->post("/theme/saveThemeConfig", "V1\\Admin\\ThemeController@saveThemeConfig");
            $router->post("/theme/getThemeConfig", "V1\\Admin\\ThemeController@getThemeConfig");
        });
    }
}

?>