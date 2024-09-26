<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Guest;

class PaymentController extends \App\Http\Controllers\Controller
{
    public function notify($method, $uuid, \Illuminate\Http\Request $request)
    {
        try {
            $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_ = new \App\Services\PaymentService($method, NULL, $uuid);
            $_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_ = $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_->notify($request->input());
            $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_ = $_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_["trade_no"];
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_)->first();
            $user = \App\Models\User::where("id", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id)->first();
            if(!$_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_) {
                abort(500, "verify error");
            }
            if(!$this->handle($_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_["trade_no"], $_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_["callback_no"])) {
                abort(500, "handle error");
            }
            if(config("aikopanel.email_payments_success", 0)) {
                $_obfuscated_0D282E0A3940040C25265C033832193E0605193F211822_ = new \App\Services\MailService();
                $_obfuscated_0D282E0A3940040C25265C033832193E0605193F211822_->paymentNotifyToUser($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_, $user);
            }
            exit(isset($_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_["custom_result"]) ? $_obfuscated_0D18160D072901311B380D32392726311A0D1728071801_["custom_result"] : "success");
        } catch (\Exception $ex) {
            \Log::error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_);
            abort(500, "fail");
        }
    }
    private function handle($tradeNo, $callbackNo)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $tradeNo)->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, "order is not found");
        }
        $user = \App\Models\User::find($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id);
        if(!$user) {
            abort(500, __("The user does not exist"));
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status !== 0) {
            return true;
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        if(!$_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->paid($callbackNo)) {
            return false;
        }
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id);
        if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
            $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_ = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->name;
        } else {
            abort(500, __("The plan does not exist"));
        }
        $_obfuscated_0D36043B362F091B130D321803143210053C253B1E1D01_ = ["one_day_price" => "1 Ngày", "week_price" => "1 Tuần", "month_price" => "1 Tháng", "two_month_price" => "2 Tháng", "quarter_price" => "3 Tháng", "half_year_price" => "6 Tháng", "year_price" => "1 Năm", "two_year_price" => "2 Năm", "three_year_price" => "3 Năm", "onetime_price" => "Vĩnh Viễn", "reset_price" => "Reset Data", "recharge" => "Nạp Tiền"];
        $_obfuscated_0D1F281E155C143B29103F35392C1E06022C3B26312401_ = $_obfuscated_0D36043B362F091B130D321803143210053C253B1E1D01_[$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->period];
        $_obfuscated_0D0F363E392D115B043F1C3236341812363C2E2F281432_ = $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount / 100;
        $_obfuscated_0D0A031111333B1D3D2840400E352A2A3234361D052E01_ = number_format($_obfuscated_0D0F363E392D115B043F1C3236341812363C2E2F281432_, 0, ",", ".");
        $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ = \App\Models\User::find($user->invite_user_id);
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = sprintf("✅Đã Duyệt Đơn: %s - %s ₫\n\n🛒Gói: %s\n📧Từ: %s%s\n🆔User: %s【HSD: %s】\n\n♻CTT: %s\n♻Mã giao dịch: %s\n♻MĐH: %s", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->id, $_obfuscated_0D0A031111333B1D3D2840400E352A2A3234361D052E01_, $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_, $user->email, $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ && $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->email ? " | CTV: " . $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->email : "", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id, $_obfuscated_0D1F281E155C143B29103F35392C1E06022C3B26312401_, \App\Models\Payment::where("id", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->payment_id)->first()->name, $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->callback_no, $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no);
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessageWithAdmin($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_);
        if($user->invite_user_id !== NULL && $user->invite_user_id !== 0 && $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ && $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->telegram_id !== NULL && $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->is_staff) {
            if(config("staff.aikopanel-id-" . $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->id . ".telegram_bot_token") === NULL) {
                return true;
            }
            $_obfuscated_0D055B34230E1014323326163C14320C40011B0C271201_ = new \App\Services\TelegramService("", $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->id);
            $_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_ = sprintf("✅Đã Duyệt Đơn: %s - %s ₫\n\n🛒Gói: %s\n📧Từ: `%s`\n🆔User: %s【HSD: %s】", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->id, $_obfuscated_0D0A031111333B1D3D2840400E352A2A3234361D052E01_, $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_, $user->email, $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id, $_obfuscated_0D1F281E155C143B29103F35392C1E06022C3B26312401_);
            $_obfuscated_0D055B34230E1014323326163C14320C40011B0C271201_->sendMessageWithStaff($_obfuscated_0D0A39351219070303333F5C1132252F253D171E362301_, $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->id);
        }
        return true;
    }
}

?>