<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class TicketService
{
    public function reply($ticket, $message, $userId)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        $_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_ = \App\Models\TicketMessage::create(["user_id" => $userId, "ticket_id" => $ticket->id, "message" => $message]);
        if($userId !== $ticket->user_id) {
            $ticket->reply_status = 0;
        } else {
            $ticket->reply_status = 1;
        }
        if(!$_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_ || !$ticket->save()) {
            \Illuminate\Support\Facades\DB::rollback();
            return false;
        }
        \Illuminate\Support\Facades\DB::commit();
        return $_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_;
    }
    public function replyByAdmin($ticketId, $message, $userId)
    {
        $ticket = \App\Models\Ticket::where("id", $ticketId)->first();
        if(!$ticket) {
            abort(500, "Thứ tự công việc không tồn tại");
        }
        $ticket->status = 0;
        \Illuminate\Support\Facades\DB::beginTransaction();
        $_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_ = \App\Models\TicketMessage::create(["user_id" => $userId, "ticket_id" => $ticket->id, "message" => $message]);
        if($userId !== $ticket->user_id) {
            $ticket->reply_status = 0;
        } else {
            $ticket->reply_status = 1;
        }
        if(!$_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_ || !$ticket->save()) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, "Trả lời công việc không thành công");
        }
        \Illuminate\Support\Facades\DB::commit();
        $this->sendEmailNotify($ticket, $_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_);
    }
    private function sendEmailNotify(\App\Models\Ticket $ticket, \App\Models\TicketMessage $ticketMessage)
    {
        $user = \App\Models\User::find($ticket->user_id);
        $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = "ticket_sendEmailNotify_" . $ticket->user_id;
        if(!\Illuminate\Support\Facades\Cache::get($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_)) {
            \Illuminate\Support\Facades\Cache::put($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, 1, 1800);
            \App\Jobs\SendEmailJob::dispatch(["email" => $user->email, "subject" => "Bạn" . config("aikopanel.app_name", "AikoPanel") . "Đơn đặt hàng công việc đã trả lời", "template_name" => "notify", "template_value" => ["name" => config("aikopanel.app_name", "AikoPanel"), "url" => config("aikopanel.app_url"), "content" => "Chủ đề：" . $ticket->subject . "\r\nNội dung phục hồi：" . $ticketMessage->message]]);
        }
    }
}

?>