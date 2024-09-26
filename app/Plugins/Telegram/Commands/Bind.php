<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram\Commands;

class Bind extends \App\Plugins\Telegram\Telegram
{
    public $command = "/bind";
    public $description = "Liên kết tài khoản Telegram với trang web";
    public function handle($message, $match = [])
    {
        if(!$message->is_private) {
            return NULL;
        }
        if(!isset($message->args[0])) {
            abort(500, "Các tham số đã sai, vui lòng mang địa chỉ đăng ký để gửi");
        }
        $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = $message->args[0];
        $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = parse_url($_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_);
        parse_str($_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_["query"], $query);
        $_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_ = $query["token"];
        if(!$_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_) {
            abort(500, "Đăng ký địa chỉ không hợp lệ");
        }
        $user = \App\Models\User::where("token", $_obfuscated_0D0F2924300B1E30122C040B210102121F23220E1D2622_)->first();
        if(!$user) {
            abort(500, "người dùng không tồn tại");
        }
        if($user->telegram_id) {
            abort(500, "Tài khoản này đã bị ràng buộc với tài khoản Telegram");
        }
        $user->telegram_id = $message->chat_id;
        if(!$user->save()) {
            abort(500, "Thiết lập không thành công");
        }
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = $this->telegramService;
        $telegramService->sendMessage($message->chat_id, "Ràng buộc thành công");
    }
}

?>