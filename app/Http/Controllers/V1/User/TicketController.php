<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class TicketController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = $request->user["id"];
        $_obfuscated_0D1813122C061F065C3C3F17190D0921291A083D1D0901_ = $request->input("id");
        if($_obfuscated_0D1813122C061F065C3C3F17190D0921291A083D1D0901_) {
            $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("id", $_obfuscated_0D1813122C061F065C3C3F17190D0921291A083D1D0901_)->firstOrFail();
            $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"] = \App\Models\TicketMessage::where("ticket_id", $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->id)->get();
            for ($i = 0; $i < count($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"]); $i++) {
                if($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["user_id"] !== $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->user_id) {
                    $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["is_me"] = true;
                } else {
                    $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_["message"][$i]["is_me"] = false;
                }
            }
            return response(["data" => $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_]);
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("user_id", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_)->orderBy("created_at", "DESC")->get();
        return response(["data" => $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_]);
    }
    public function save(\App\Http\Requests\User\TicketSave $request)
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            if((int) \App\Models\Ticket::where("status", 0)->where("user_id", $request->user["id"])->lockForUpdate()->count()) {
                throw new \Exception(__("There are other unresolved tickets"));
            }
            $_obfuscated_0D3E252A3C193332373233183C05083614171B40181322_ = $request->only(["subject", "level"]) + ["user_id" => $request->user["id"]];
            $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::create($_obfuscated_0D3E252A3C193332373233183C05083614171B40181322_);
            \App\Models\TicketMessage::create(["user_id" => $request->user["id"], "ticket_id" => $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->id, "message" => $request->input("message")]);
            \Illuminate\Support\Facades\DB::commit();
            $this->sendNotify($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_, $request->input("message"), $request->user["id"]);
            return response(["data" => true]);
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    public function reply(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, __("Invalid parameter"));
        }
        if(!$request->input("message")) {
            abort(500, __("Message cannot be empty"));
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("id", $request->input("id"))->where("user_id", $request->user["id"])->first();
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
            abort(500, __("Ticket does not exist"));
        }
        if($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->status) {
            abort(500, __("The ticket is closed and cannot be replied"));
        }
        if($request->user["id"] == $this->getLastMessage($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->id)->user_id) {
            abort(500, __("Please wait for the technical enginneer to reply"));
        }
        $_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_ = new \App\Services\TicketService();
        if(!$_obfuscated_0D155C2C1F0E191E382A371E2B0D0315021B28233E1232_->reply($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_, $request->input("message"), $request->user["id"])) {
            abort(500, __("Ticket reply failed"));
        }
        $this->sendNotify($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_, $request->input("message"), $request->user["id"]);
        return response(["data" => true]);
    }
    public function close(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!$request->input("id")) {
            abort(500, __("Invalid parameter"));
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::where("id", $request->input("id"))->where("user_id", $request->user["id"])->first();
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
            abort(500, __("Ticket does not exist"));
        }
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->status = 1;
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->save()) {
            abort(500, __("Close failed"));
        }
        return response(["data" => true]);
    }
    private function getLastMessage($ticketId)
    {
        return \App\Models\TicketMessage::where("ticket_id", $ticketId)->orderBy("id", "DESC")->first();
    }
    public function withdraw(\App\Http\Requests\User\TicketWithdraw $request)
    {
        if((int) config("aikopanel.withdraw_close_enable", 0)) {
            abort(500, "user.ticket.withdraw.not_support_withdraw");
        }
        if(!in_array($request->input("withdraw_method"), config("aikopanel.commission_withdraw_method", \App\Utils\Dict::WITHDRAW_METHOD_WHITELIST_DEFAULT))) {
            abort(500, __("Unsupported withdrawal method"));
        }
        $user = \App\Models\User::find($request->user["id"]);
        $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_ = config("aikopanel.commission_withdraw_limit", 100);
        if($user->commission_balance / 100 < $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_) {
            abort(500, __("The current required minimum withdrawal commission is :limit", ["limit" => $_obfuscated_0D052B3C3837113219163E0C0319350B1E1F2310293F32_]));
        }
        if($user->commission_balance / 100 < $request->input("withdraw_amount")) {
            abort(500, __("The withdrawal amount cannot be greater than the current commission balance"));
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_ = __("[Commission Withdrawal Request] This ticket is opened by the system");
        $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_ = \App\Models\Ticket::create(["subject" => $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_, "level" => 2, "user_id" => $request->user["id"]]);
        if(!$_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, __("Failed to open ticket"));
        }
        if(config("aikopanel.deduct_commission_enable", 0)) {
            $user->commission_balance -= $request->input("withdraw_amount") * 100;
            if(!$user->save()) {
                \Illuminate\Support\Facades\DB::rollback();
                abort(500, __("Failed to open ticket"));
            }
        }
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = sprintf("- %s\n- %s\n- %s\n- %s\n", __("Withdrawal method") . "：" . $request->input("withdraw_method"), __("Withdrawal account") . "：" . $request->input("withdraw_account"), __("Withdrawal name") . "：" . $request->input("withdraw_name"), __("Withdrawal amount") . "：" . number_format($request->input("withdraw_amount"), 0, ",", ".") . " " . __("VND"));
        $_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_ = \App\Models\TicketMessage::create(["user_id" => $request->user["id"], "ticket_id" => $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->id, "message" => $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_]);
        if(!$_obfuscated_0D1B051D072C253E2A300C11400E21022B281E3E3C2232_) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, __("Failed to open ticket"));
        }
        \Illuminate\Support\Facades\DB::commit();
        $this->sendNotify($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_, $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
        return response(["data" => true]);
    }
    private function sendNotify(\App\Models\Ticket $ticket, $message, $userid = NULL)
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        if(!empty($userid)) {
            $user = \App\Models\User::find($userid);
            if($user) {
                $_obfuscated_0D33042A1F23100D041B0E082F11353E0634353C0A4022_ = $this->getFlowData($user->transfer_enable);
                $_obfuscated_0D21082B295B011E231E14280C2835350A1636380D5B32_ = $this->getFlowData($user->transfer_enable - $user->u - $user->d);
                $u = $this->getFlowData($user->u);
                $d = $this->getFlowData($user->d);
                $_obfuscated_0D0F5C310C31052A3C0E2B042F28232C0C1A25151F3201_ = date("d-m-Y h:m:s", $user->expired_at);
                if(isset($_SERVER["HTTP_X_REAL_IP"])) {
                    $_obfuscated_0D2B3F1618080F062B0325022B1923321217210B133E22_ = $_SERVER["HTTP_X_REAL_IP"];
                } elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                    list($_obfuscated_0D2B3F1618080F062B0325022B1923321217210B133E22_) = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                } else {
                    $_obfuscated_0D2B3F1618080F062B0325022B1923321217210B133E22_ = $_SERVER["REMOTE_ADDR"];
                }
                $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::where("id", $user->plan_id)->first();
                $_obfuscated_0D0B1F19072C0F231E31265B3D1F265B400B5B15320F01_ = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ ? $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->name : "Không có thông tin gói";
                $_obfuscated_0D1D2C1B34282F060B3E1429023D0E1D17260E35060811_ = $user->balance / 100;
                $_obfuscated_0D37112F390B061D125B1E093F0F2122132A1B08371532_ = $user->commission_balance / 100;
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin("📮Lời nhắc nhở#" . $ticket->id . "\n———————————————\nThư：`" . $user->email . "`\nIP:" . $_obfuscated_0D2B3F1618080F062B0325022B1923321217210B133E22_ . "\nTraffic：`" . $_obfuscated_0D0B1F19072C0F231E31265B3D1F265B400B5B15320F01_ . " of " . $_obfuscated_0D21082B295B011E231E14280C2835350A1636380D5B32_ . "/" . $transfer_enable . "`\nUP/DOWN：`" . $u . "/" . $d . "`\nHạn sử dụng: `" . $expired_at . "`\nSố dư/Số dư hoa hồng：`" . $_obfuscated_0D1D2C1B34282F060B3E1429023D0E1D17260E35060811_ . "/" . $_obfuscated_0D37112F390B061D125B1E093F0F2122132A1B08371532_ . "`\nChủ đề：\n`" . $ticket->subject . "`\nNội dung：\n`" . $message . "`", true);
            } else {
                $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin("User data not found for user ID: " . $userid, true);
            }
        } else {
            $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin("📮Lời nhắc nhở #" . $ticket->id . "\n———————————————\nChủ đề：\n`" . $ticket->subject . "`\nNội dung：\n`" . $message . "`", true);
        }
    }
    private function getFlowData($b)
    {
        $_obfuscated_0D37221403340A5C333D063C5B10290840150F5B290A32_ = $b / 1073741824;
        $m = $b / 1048576;
        if(1 <= $_obfuscated_0D37221403340A5C333D063C5B10290840150F5B290A32_) {
            $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_ = round($_obfuscated_0D37221403340A5C333D063C5B10290840150F5B290A32_, 2) . "GB";
        } else {
            $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_ = round($m, 2) . "MB";
        }
        return $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_;
    }
}

?>