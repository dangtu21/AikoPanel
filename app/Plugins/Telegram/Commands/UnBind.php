<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram\Commands;

class UnBind extends \App\Plugins\Telegram\Telegram
{
    public $command = "/unbind";
    public $description = "Tháo tài khoản Telegram từ trang web";
    public function handle($message, $match = [])
    {
        if(!$message->is_private) {
            return NULL;
        }
        $user = \App\Models\User::where("telegram_id", $message->chat_id)->first();
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = $this->telegramService;
        if(!$user) {
            $telegramService->sendMessage($message->chat_id, "Không có truy vấn thông tin người dùng của bạn, vui lòng liên kết tài khoản trước", "markdown");
        } else {
            $user->telegram_id = NULL;
            if(!$user->save()) {
                abort(500, "Không liên kết thất bại");
            }
            $telegramService->sendMessage($message->chat_id, "Thành công Unbind", "markdown");
        }
    }
}

?>