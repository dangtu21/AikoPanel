<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class OrderService
{
    public $order;
    public $user;
    const STR_TO_TIME = ["one_day_price" => 1, "week_price" => 7, "month_price" => 30, "two_month_price" => 60, "quarter_price" => 90, "half_year_price" => 180, "year_price" => 365, "two_year_price" => 730, "three_year_price" => 1095];
    public function __construct(\App\Models\Order $order)
    {
        $this->order = $order;
    }
    public function open()
    {
        $order = $this->order;
        $this->user = \App\Models\User::find($order->user_id);
        if($order->refund_amount) {
            $this->user->balance = $this->user->balance + $order->refund_amount;
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            if($order->plan_id === 0) {
                $this->buyByRecharge();
            } else {
                $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($order->plan_id);
                if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
                    abort(500, "Không tìm thấy gói dịch vụ");
                }
                $this->setSpeedLimit($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->speed_limit);
                switch ((string) $order->period) {
                    case "onetime_price":
                        $this->buyByOneTime($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_);
                        break;
                    case "reset_price":
                        $this->buyByResetTraffic();
                        break;
                    default:
                        $this->buyByPeriod($order, $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_);
                        switch ((int) $order->type) {
                            case 1:
                                $this->openEvent(config("aikopanel.new_order_event_id", 0));
                                break;
                            case 2:
                                $this->openEvent(config("aikopanel.renew_order_event_id", 0));
                                break;
                            case 3:
                                $this->openEvent(config("aikopanel.change_order_event_id", 0));
                                break;
                            case 5:
                                $this->openEvent(config("aikopanel.custom_order_event_id", 0));
                                break;
                        }
                }
            }
            $order->status = 3;
            if(!$order->save() || !$this->user->save()) {
                throw new \Exception("Không thể cập nhật thông tin");
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    public function setOrderType(\App\Models\User $user)
    {
        $order = $this->order;
        if($order->period === "reset_price") {
            $order->type = 4;
        } elseif($user->plan_id !== NULL && $order->plan_id !== $user->plan_id && (time() < $user->expired_at || $user->expired_at === NULL)) {
            if(!(int) config("aikopanel.plan_change_enable", 1)) {
                abort(500, "Nếu bạn không được phép thay đổi đăng ký, vui lòng liên hệ với dịch vụ khách hàng hoặc gửi hoạt động đặt hàng công việc");
            }
            $order->type = 3;
            if((int) config("aikopanel.surplus_enable", 1)) {
                $this->getSurplusValue($user, $order);
            }
            if($order->total_amount <= $order->surplus_amount) {
                $order->refund_amount = $order->surplus_amount - $order->total_amount;
                $order->total_amount = 0;
            } else {
                $order->total_amount = $order->total_amount - $order->surplus_amount;
            }
        } elseif(time() < $user->expired_at && $order->plan_id == $user->plan_id) {
            $order->type = 2;
        } else {
            $order->type = 1;
        }
    }
    public function setVipDiscount(\App\Models\User $user)
    {
        $order = $this->order;
        if($user->discount) {
            $order->discount_amount = $order->discount_amount + $order->total_amount * $user->discount / 100;
        }
        $order->total_amount = $order->total_amount - $order->discount_amount;
    }
    public function setInvite($user)
    {
        $order = $this->order;
        if($user->invite_user_id && $order->total_amount <= 0) {
            return NULL;
        }
        $order->invite_user_id = $user->invite_user_id;
        $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_ = \App\Models\User::find($user->invite_user_id);
        if(!$_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_) {
            return NULL;
        }
        $_obfuscated_0D2102230A0C3F252D2A28091D323C361D331A5C293332_ = false;
        switch ((int) $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->commission_type) {
            case 0:
                $_obfuscated_0D3F353D332622221E022B291C211F1B073F2D37283B11_ = (int) config("aikopanel.commission_first_time_enable", 1);
                !$_obfuscated_0D3F353D332622221E022B291C211F1B073F2D37283B11_ or $_obfuscated_0D2102230A0C3F252D2A28091D323C361D331A5C293332_ = !$_obfuscated_0D3F353D332622221E022B291C211F1B073F2D37283B11_ || $_obfuscated_0D3F353D332622221E022B291C211F1B073F2D37283B11_ && !$this->haveValidOrder($user);
                break;
            case 1:
                $_obfuscated_0D2102230A0C3F252D2A28091D323C361D331A5C293332_ = true;
                break;
            case 2:
                $_obfuscated_0D2102230A0C3F252D2A28091D323C361D331A5C293332_ = !$this->haveValidOrder($user);
                break;
            default:
                if(!$_obfuscated_0D2102230A0C3F252D2A28091D323C361D331A5C293332_) {
                    return NULL;
                }
                if($_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_ && $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->commission_rate) {
                    $order->commission_balance = $order->total_amount * $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->commission_rate / 100;
                } else {
                    $order->commission_balance = $order->total_amount * config("aikopanel.invite_commission", 10) / 100;
                }
        }
    }
    private function haveValidOrder(\App\Models\User $user)
    {
        return \App\Models\Order::where("user_id", $user->id)->whereNotIn("status", [0, 2])->first();
    }
    private function getSurplusValue(\App\Models\User $user, \App\Models\Order $order)
    {
        if($user->expired_at === NULL) {
            $this->getSurplusValueByOneTime($user, $order);
        } else {
            $this->getSurplusValueByPeriod($user, $order);
        }
    }
    private function getSurplusValueByOneTime(\App\Models\User $user, \App\Models\Order $order)
    {
        $_obfuscated_0D39403F241A05082334350B25235C3C3721062E091222_ = \App\Models\Order::where("user_id", $user->id)->where("period", "onetime_price")->where("status", 3)->orderBy("id", "DESC")->first();
        if(!$_obfuscated_0D39403F241A05082334350B25235C3C3721062E091222_) {
            return NULL;
        }
        $_obfuscated_0D3F5B2D5C09023D112D2F0A180F161040352F010D0B22_ = $user->transfer_enable / 1073741824;
        if(!$_obfuscated_0D3F5B2D5C09023D112D2F0A180F161040352F010D0B22_) {
            return NULL;
        }
        $_obfuscated_0D122D081C3E263323173615073F182E1117333E021301_ = $_obfuscated_0D39403F241A05082334350B25235C3C3721062E091222_->total_amount + $_obfuscated_0D39403F241A05082334350B25235C3C3721062E091222_->balance_amount;
        if(!$_obfuscated_0D122D081C3E263323173615073F182E1117333E021301_) {
            return NULL;
        }
        $_obfuscated_0D313D1122391C21150B3B041633080E03222221030301_ = $_obfuscated_0D122D081C3E263323173615073F182E1117333E021301_ / $_obfuscated_0D3F5B2D5C09023D112D2F0A180F161040352F010D0B22_;
        $_obfuscated_0D312A14062D1B16091B07280127221E15033F253E1011_ = $_obfuscated_0D3F5B2D5C09023D112D2F0A180F161040352F010D0B22_ - ($user->u + $user->d) / 1073741824;
        $result = $_obfuscated_0D313D1122391C21150B3B041633080E03222221030301_ * $_obfuscated_0D312A14062D1B16091B07280127221E15033F253E1011_;
        $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_ = \App\Models\Order::where("user_id", $user->id)->where("period", "!=", "reset_price")->where("status", 3);
        $order->surplus_amount = 0 < $result ? $result : 0;
        $order->surplus_order_ids = array_column($_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->get()->toArray(), "id");
    }
    private function getSurplusValueByPeriod(\App\Models\User $user, \App\Models\Order $order)
    {
        $_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ = \App\Models\Order::where("user_id", $user->id)->where("period", "!=", "reset_price")->where("period", "!=", "onetime_price")->where("status", 3)->get()->toArray();
        if(!$_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_) {
            return NULL;
        }
        $_obfuscated_0D2C32401D1A171E223C1F2B5B14250F061F5C1B210501_ = 0;
        $_obfuscated_0D162A1632270D0424212E3538061C1E16331D2F323C32_ = 0;
        $_obfuscated_0D3D073E392A3034082618093E29175B1835185B323122_ = 0;
        foreach ($_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            $period = self::STR_TO_TIME[$_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["period"]];
            if(strtotime("+" . $period . " month", $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["created_at"]) < time()) {
            } else {
                $_obfuscated_0D3D073E392A3034082618093E29175B1835185B323122_ = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["created_at"];
                $_obfuscated_0D162A1632270D0424212E3538061C1E16331D2F323C32_ = $period + $_obfuscated_0D162A1632270D0424212E3538061C1E16331D2F323C32_;
                $_obfuscated_0D2C32401D1A171E223C1F2B5B14250F061F5C1B210501_ = $_obfuscated_0D2C32401D1A171E223C1F2B5B14250F061F5C1B210501_ + ($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["total_amount"] + $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["balance_amount"] + $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["surplus_amount"]) - $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["refund_amount"];
            }
        }
        if(!$_obfuscated_0D3D073E392A3034082618093E29175B1835185B323122_) {
            return NULL;
        }
        $_obfuscated_0D26160B23250E2F3C3B0F3C060B0825161A121D031D32_ = strtotime("+" . $_obfuscated_0D162A1632270D0424212E3538061C1E16331D2F323C32_ . " month", $_obfuscated_0D3D073E392A3034082618093E29175B1835185B323122_);
        if($_obfuscated_0D26160B23250E2F3C3B0F3C060B0825161A121D031D32_ < time()) {
            return NULL;
        }
        $_obfuscated_0D1D27371934082E10362930055B3B2B110B2528192922_ = $_obfuscated_0D26160B23250E2F3C3B0F3C060B0825161A121D031D32_ - time();
        $_obfuscated_0D2929252B323F1B3F2B2221133B233B02313D13062432_ = $_obfuscated_0D26160B23250E2F3C3B0F3C060B0825161A121D031D32_ - $_obfuscated_0D3D073E392A3034082618093E29175B1835185B323122_;
        $_obfuscated_0D2F231B2330380F0E3007041208051F1A280E2F150701_ = $_obfuscated_0D2C32401D1A171E223C1F2B5B14250F061F5C1B210501_ / $_obfuscated_0D2929252B323F1B3F2B2221133B233B02313D13062432_;
        $_obfuscated_0D132C080D0C1A2A320C300B3829310B1036010C3B0622_ = $_obfuscated_0D2F231B2330380F0E3007041208051F1A280E2F150701_ * $_obfuscated_0D1D27371934082E10362930055B3B2B110B2528192922_;
        if(!$_obfuscated_0D1D27371934082E10362930055B3B2B110B2528192922_ || !$_obfuscated_0D132C080D0C1A2A320C300B3829310B1036010C3B0622_) {
            return NULL;
        }
        $order->surplus_amount = 0 < $_obfuscated_0D132C080D0C1A2A320C300B3829310B1036010C3B0622_ ? $_obfuscated_0D132C080D0C1A2A320C300B3829310B1036010C3B0622_ : 0;
        $order->surplus_order_ids = array_column($_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_, "id");
    }
    public function paid($callbackNo)
    {
        $order = $this->order;
        if($order->status !== 0 && $order->status !== 2) {
            return true;
        }
        $order->status = 1;
        $order->paid_at = time();
        $order->callback_no = $callbackNo;
        if(!$order->save()) {
            return false;
        }
        try {
            \App\Jobs\OrderHandleJob::dispatchNow($order->trade_no);
        } catch (\Exception $ex) {
            return false;
        }
        return true;
    }
    public function cancel()
    {
        $order = $this->order;
        \Illuminate\Support\Facades\DB::beginTransaction();
        $order->status = 2;
        if(!$order->save()) {
            \Illuminate\Support\Facades\DB::rollBack();
            return false;
        }
        if($order->balance_amount) {
            $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new UserService();
            if(!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->addBalance($order->user_id, $order->balance_amount)) {
                \Illuminate\Support\Facades\DB::rollBack();
                return false;
            }
        }
        \Illuminate\Support\Facades\DB::commit();
        return true;
    }
    private function setSpeedLimit($speedLimit)
    {
        $this->user->speed_limit = $speedLimit;
    }
    private function buyByResetTraffic()
    {
        $this->user->u = 0;
        $this->user->d = 0;
    }
    private function buyByRecharge()
    {
        $this->user->balance += $this->order->total_amount;
        if(!$this->user->save()) {
            throw new \Exception("Không thể cập nhật số dư người dùng");
        }
    }
    private function buyByPeriod(\App\Models\Order $order, \App\Models\Plan $plan)
    {
        if((int) $order->type === 3) {
            $this->user->expired_at = time();
        }
        $this->user->transfer_enable = $plan->transfer_enable * 1073741824;
        $this->user->device_limit = $plan->device_limit;
        $this->user->appleid_limit = $plan->appleid_limit;
        $this->user->reset_traffic_method = $plan->reset_traffic_method;
        $this->user->sni = $plan->sni;
        if($this->user->expired_at === NULL) {
            $this->buyByResetTraffic();
        }
        if($order->type === 1) {
            $this->buyByResetTraffic();
        }
        $_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ = date("d", $this->user->expired_at);
        $_obfuscated_0D15165C1803043D1328103219212F13351A1111375C11_ = date("m", $this->user->expired_at);
        $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ = date("d");
        $_obfuscated_0D342E0C1533133F311207132425393E04362A373B2D32_ = date("m");
        if($order->type === 2 && $_obfuscated_0D15165C1803043D1328103219212F13351A1111375C11_ == $_obfuscated_0D342E0C1533133F311207132425393E04362A373B2D32_ && $_obfuscated_0D11220C3F5B293B25370E0F1D27243D3F34143F1E0D11_ === $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_) {
            $this->buyByResetTraffic();
        }
        $this->user->plan_id = $plan->id;
        $this->user->group_id = $plan->group_id;
        $this->user->expired_at = $this->getTime($order->period, $this->user->expired_at);
    }
    private function buyByOneTime(\App\Models\Plan $plan)
    {
        $this->buyByResetTraffic();
        $this->user->transfer_enable = $plan->transfer_enable * 1073741824;
        $this->user->device_limit = $plan->device_limit;
        $this->user->appleid_limit = $plan->appleid_limit;
        $this->user->sni = $plan->sni;
        $this->user->plan_id = $plan->id;
        $this->user->group_id = $plan->group_id;
        $this->user->expired_at = NULL;
    }
    private function getTime($str, $timestamp)
    {
        if($timestamp < time()) {
            $timestamp = time();
        }
        switch ($str) {
            case "one_day_price":
                return strtotime("+1 days", $timestamp);
                break;
            case "week_price":
                return strtotime("+7 days", $timestamp);
                break;
            case "month_price":
                return strtotime("+30 days", $timestamp);
                break;
            case "two_month_price":
                return strtotime("+60 days", $timestamp);
                break;
            case "quarter_price":
                return strtotime("+90 days", $timestamp);
                break;
            case "half_year_price":
                return strtotime("+180 days", $timestamp);
                break;
            case "year_price":
                return strtotime("+365 days", $timestamp);
                break;
            case "two_year_price":
                return strtotime("+730 days", $timestamp);
                break;
            case "three_year_price":
                return strtotime("+1095 days", $timestamp);
                break;
        }
    }
    private function openEvent($eventId)
    {
        switch ((int) $eventId) {
            case 0:
            case 1:
                $this->buyByResetTraffic();
                break;
        }
    }
}

?>