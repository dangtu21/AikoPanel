<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram\Commands;

class GetLatestUrl extends \App\Plugins\Telegram\Telegram
{
    public $command = "/getlatesturl";
    public $description = "Liên kết tài khoản Telegram với trang web";
    public function handle($message, $match = [])
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = $this->telegramService;
        $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_ = sprintf("%sTrang web mới nhất là：%s", config("aikopanel.app_name", "AikoPanel"), config("aikopanel.app_url"));
        $telegramService->sendMessage($message->chat_id, $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_, "markdown");
    }
}

?>