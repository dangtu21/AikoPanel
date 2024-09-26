<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class OrderController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\Order::where("user_id", $request->user["id"])->orderBy("created_at", "DESC");
        if($request->input("status") !== NULL) {
            $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->where("status", $request->input("status"));
        }
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->get();
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::get();
        for ($i = 0; $i < count($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_); $i++) {
            if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_[$i]["plan_id"] == 0) {
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_[$i]["plan"] = ["name" => "Nạp tiền", "recharge" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_[$i]["total_amount"]];
            } else {
                for ($x = 0; $x < count($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_); $x++) {
                    if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_[$i]["plan_id"] === $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$x]["id"]) {
                        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_[$i]["plan"] = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$x];
                    }
                }
            }
        }
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->makeHidden(["id", "user_id"])]);
    }
    public function detail(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("user_id", $request->user["id"])->where("trade_no", $request->input("trade_no"))->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, __("Order does not exist or has been paid"));
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id == 0) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["plan"] = (object) ["name" => "Nạp Tiền", "recharge" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount];
        } else {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["plan"] = \App\Models\Plan::find($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id);
            if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["plan"]) {
                abort(500, __("Subscription plan does not exist"));
            }
        }
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["try_out_plan_id"] = (int) config("aikopanel.try_out_plan_id");
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["plan"]) {
            abort(500, __("Subscription plan does not exist"));
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->surplus_order_ids) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["surplus_orders"] = \App\Models\Order::whereIn("id", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->surplus_order_ids)->get();
        }
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_]);
    }
    public function save(\App\Http\Requests\User\OrderSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        if($_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isNotCompleteOrderByUserId($request->user["id"])) {
            abort(500, __("You have an unpaid or pending order, please try again later or cancel it"));
        }
        $_obfuscated_0D260612152504080F392F3B111D2B0C0C3D2928393601_ = new \App\Services\PlanService($request->input("plan_id"));
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = $_obfuscated_0D260612152504080F392F3B111D2B0C0C3D2928393601_->plan;
        $user = \App\Models\User::find($request->user["id"]);
        if(!$plan) {
            abort(500, __("Subscription plan does not exist"));
        }
        if($user->plan_id !== $plan->id && !$_obfuscated_0D260612152504080F392F3B111D2B0C0C3D2928393601_->haveCapacity() && $request->input("period") !== "reset_price") {
            abort(500, __("Current product is sold out"));
        }
        if($plan[$request->input("period")] === NULL) {
            abort(500, __("This payment period cannot be purchased, please choose another period"));
        }
        if($request->input("period") === "reset_price" && (!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user) || $plan->id !== $user->plan_id)) {
            abort(500, __("Subscription has expired or no active subscription, unable to purchase Data Reset Package"));
        }
        if((!$plan->show && !$plan->renew || !$plan->show && $user->plan_id !== $plan->id) && $request->input("period") !== "reset_price") {
            abort(500, __("This subscription has been sold out, please choose another subscription"));
        }
        if(!$plan->renew && $user->plan_id == $plan->id && $request->input("period") !== "reset_price") {
            abort(500, __("This subscription cannot be renewed, please change to another subscription"));
        }
        if(!$plan->show && $plan->renew && !$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user)) {
            abort(500, __("This subscription has expired, please change to another subscription"));
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = new \App\Models\Order();
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id = $request->user["id"];
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id = $plan->id;
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->period = $request->input("period");
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no = \App\Utils\Helper::generateOrderNo();
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount = $plan[$request->input("period")];
        if($request->input("coupon_code")) {
            $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_ = new \App\Services\CouponService($request->input("coupon_code"));
            if(!$_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->use($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_)) {
                \Illuminate\Support\Facades\DB::rollBack();
                abort(500, __("Coupon failed"));
            }
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->coupon_id = $_obfuscated_0D023904383F26013B2E150E2B2C180D33031A031B5B01_->getId();
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->setVipDiscount($user);
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->setOrderType($user);
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->setInvite($user);
        if($user->balance && 0 < $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount) {
            $_obfuscated_0D1C103C23180B310D5B36092506313033281D1B191232_ = $user->balance - $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount;
            $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
            if(0 < $_obfuscated_0D1C103C23180B310D5B36092506313033281D1B191232_) {
                if(!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->addBalance($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id, -1 * $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount)) {
                    \Illuminate\Support\Facades\DB::rollBack();
                    abort(500, __("Insufficient balance"));
                }
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->balance_amount = $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount;
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount = 0;
            } else {
                if(!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->addBalance($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id, -1 * $user->balance)) {
                    \Illuminate\Support\Facades\DB::rollBack();
                    abort(500, __("Insufficient balance"));
                }
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->balance_amount = $user->balance;
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount = $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount - $user->balance;
            }
        }
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save()) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, __("Failed to create order"));
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no]);
    }
    public function reCharge(\App\Http\Requests\User\UserRecharge $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $user = \App\Models\User::find($request->user["id"]);
        if(!$user) {
            abort(500, __("Người dùng không tồn tại"));
        }
        $_obfuscated_0D080D132B160B1D223216290434101D3B061A1D1E1501_ = $request->input("recharge_amount");
        if($_obfuscated_0D080D132B160B1D223216290434101D3B061A1D1E1501_ <= 0) {
            abort(500, __("Số tiền nạp không hợp lệ"));
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = new \App\Models\Order();
            $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id = $user->id;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id = 0;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->period = "recharge";
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no = \App\Utils\Helper::generateOrderNo();
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount = $_obfuscated_0D080D132B160B1D223216290434101D3B061A1D1E1501_ * 100;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status = 0;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->type = 5;
            $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->setInvite($user);
            if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save()) {
                throw new \Exception(__("Không thể tạo đơn nạp tiền"));
            }
            \Illuminate\Support\Facades\DB::commit();
            return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no]);
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    public function checkout(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_ = $request->input("trade_no");
        $_obfuscated_0D2129053B1E363D19390F0539081012140D3234031D11_ = $request->input("method");
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_)->where("user_id", $request->user["id"])->where("status", 0)->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, __("Order does not exist or has been paid"));
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount <= 0) {
            $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
            if(!$_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->paid($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no)) {
                abort(500, "");
            }
            return response(["type" => -1, "data" => true]);
        }
        $_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_ = \App\Models\Payment::find($_obfuscated_0D2129053B1E363D19390F0539081012140D3234031D11_);
        if(!$_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_ || $_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_->enable !== 1) {
            abort(500, __("Payment method is not available"));
        }
        $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_ = new \App\Services\PaymentService($_obfuscated_0D14375C295B1F2C3921053827371A383B5B1140112832_->payment, $payment->id);
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->handling_amount = NULL;
        if($payment->handling_fee_fixed || $payment->handling_fee_percent) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->handling_amount = round($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount * $payment->handling_fee_percent / 100 + $payment->handling_fee_fixed);
        }
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->payment_id = $_obfuscated_0D2129053B1E363D19390F0539081012140D3234031D11_;
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save()) {
            abort(500, __("Request failed, please try again later"));
        }
        $result = $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_->pay(["trade_no" => $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_, "total_amount" => isset($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->handling_amount) ? $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount + $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->handling_amount : $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount, "user_id" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id, "order_id" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->id, "stripe_token" => $request->input("token")]);
        return response(["type" => $result["type"], "data" => $result["data"]]);
    }
    public function check(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_ = $request->input("trade_no");
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $_obfuscated_0D0C092631063323021F0E401F041C3B0A210E5C010711_)->where("user_id", $request->user["id"])->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, __("Order does not exist"));
        }
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status]);
    }
    public function getPaymentMethod()
    {
        $url = request()->server("HTTP_HOST");
        $_obfuscated_0D371002122D1A313C0E281828102E24160B183B010701_ = \App\Models\Payment::select(["id", "name", "payment", "icon", "handling_fee_fixed", "handling_fee_percent"])->where("enable", 1)->where(function ($query) use($query) {
            $query->where(function ($subQuery) use($subQuery) {
                $subQuery->whereJsonContains("staff_urls", $url)->orWhereNull("staff_urls");
            })->orWhereRaw("JSON_LENGTH(staff_urls) = 0")->orWhereRaw("staff_urls IS NULL");
        })->orderBy("sort", "ASC")->get();
        return response(["data" => $_obfuscated_0D371002122D1A313C0E281828102E24160B183B010701_]);
    }
    public function cancel(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!$request->input("trade_no")) {
            abort(500, __("Invalid parameter"));
        }
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $request->input("trade_no"))->where("user_id", $request->user["id"])->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, __("Order does not exist"));
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status !== 0) {
            abort(500, __("You can only cancel pending orders"));
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        if(!$_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->cancel()) {
            abort(500, __("Cancel failed"));
        }
        return response(["data" => true]);
    }
}

?>