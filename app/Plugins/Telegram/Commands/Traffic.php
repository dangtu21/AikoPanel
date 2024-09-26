<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram\Commands;

class Traffic extends \App\Plugins\Telegram\Telegram
{
    public $command = "/traffic";
    public $description = "Truy vấn thông tin giao thông";
    public function handle($message, $match = [])
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = $this->telegramService;
        if(!$message->is_private) {
            return NULL;
        }
        $user = \App\Models\User::where("telegram_id", $message->chat_id)->first();
        if(!$user) {
            $telegramService->sendMessage($message->chat_id, "Không có truy vấn thông tin người dùng của bạn, vui lòng liên kết tài khoản trước", "markdown");
        } else {
            $_obfuscated_0D2F2808350C2F172B16230F5C163B2C1A1E07221F3F22_ = \App\Utils\Helper::trafficConvert($user->transfer_enable);
            $_obfuscated_0D19370E150203150409052B3D3E14102C0F5B173E2E11_ = \App\Utils\Helper::trafficConvert($user->u);
            $_obfuscated_0D2F0B29162807315C0537071335400101011021135C11_ = \App\Utils\Helper::trafficConvert($user->d);
            $_obfuscated_0D1B1A103D2F01081A0A0E011A180718223E4040400F22_ = \App\Utils\Helper::trafficConvert($user->transfer_enable - ($user->u + $user->d));
            $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_ = "🚥Truy vấn lưu lượng\n———————————————\nTổng：`" . $_obfuscated_0D2F2808350C2F172B16230F5C163B2C1A1E07221F3F22_ . "`\nUpload：`" . $_obfuscated_0D19370E150203150409052B3D3E14102C0F5B173E2E11_ . "`\nDowload：`" . $_obfuscated_0D2F0B29162807315C0537071335400101011021135C11_ . "`\nCòn Lại：`" . $_obfuscated_0D1B1A103D2F01081A0A0E011A180718223E4040400F22_ . "`";
            $telegramService->sendMessage($message->chat_id, $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_, "markdown");
        }
    }
}

?>