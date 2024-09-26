<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram\Commands;

class ReplyTicket extends \App\Plugins\Telegram\Telegram
{
    public $regex = "/[#](.*)/";
    public $description = "Trả lời đơn đặt hàng công việc nhanh chóng";
    public function handle($message, $match = [])
    {
        if(!$message->is_private) {
            return NULL;
        }
        $this->replayTicket($message, $match[1]);
    }
    private function replayTicket($msg, $ticketId)
    {
        $user = \App\Models\User::where("telegram_id", $msg->chat_id)->first();
        if(!$user) {
            abort(500, "người dùng không tồn tại");
        }
        if(!$msg->text) {
            return NULL;
        }
        if(!($user->is_admin || $user->is_staff)) {
            return NULL;
        }
        $_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_ = new \App\Services\TicketService();
        $_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_->replyByAdmin($ticketId, $msg->text, $user->id);
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = $this->telegramService;
        $telegramService->sendMessage($msg->chat_id, "#`" . $ticketId . "` Lệnh làm việc đã được trả lời để thành công", "markdown");
        $telegramService->sendMessageWithAdmin("#`" . $ticketId . "` Lệnh làm việc có " . $user->email . " Phản ứng", true);
    }
}

?>