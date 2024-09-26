<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class CheckCommission extends \Illuminate\Console\Command
{
    protected $signature = "check:commission";
    protected $description = "Dịch vụ giảm giá";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $this->autoCheck();
        $this->autoPayCommission();
    }
    public function autoCheck()
    {
        if((int) config("aikopanel.commission_auto_check_enable", 1)) {
            $_obfuscated_0D3C3C3618213113030A1B391F0A1C2F3C321A1E3C1901_ = (int) config("aikopanel.commission_auto_check_min", 4320);
            \App\Models\Order::where("commission_status", 0)->where("invite_user_id", "!=", NULL)->where("status", 3)->where("plan_id", "!=", 0)->where("updated_at", "<=", strtotime("-" . $_obfuscated_0D3C3C3618213113030A1B391F0A1C2F3C321A1E3C1901_ . " minutes", time()))->update(["commission_status" => 1]);
        }
    }
    public function autoPayCommission()
    {
        $_obfuscated_0D3C1D110D2F160E3B2736091129250E343E1233141822_ = \App\Models\Order::where("plan_id", 0)->where("type", 5)->get();
        foreach ($_obfuscated_0D3C1D110D2F160E3B2736091129250E343E1233141822_ as $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->commission_status = 5;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->commission_balance = 0;
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save();
        }
        $_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ = \App\Models\Order::where("commission_status", 1)->where("invite_user_id", "!=", NULL)->get();
        foreach ($_obfuscated_0D3B213C1229390614143B2C1B102F0C14311E0A043211_ as $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            \Illuminate\Support\Facades\DB::beginTransaction();
            if(!$this->payHandle($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->invite_user_id, $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_)) {
                \Illuminate\Support\Facades\DB::rollBack();
            } else {
                $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->commission_status = 2;
                if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save()) {
                    \Illuminate\Support\Facades\DB::rollBack();
                } else {
                    \Illuminate\Support\Facades\DB::commit();
                }
            }
        }
    }
    public function payHandle($inviteUserId, \App\Models\Order $order)
    {
        $_obfuscated_0D35141407050F0A120F3D180C372F1F22082E37313C22_ = 3;
        if((int) config("aikopanel.commission_distribution_enable", 0)) {
            $_obfuscated_0D38231433253D3908263E04340B063703262321141F22_ = [(int) config("aikopanel.commission_distribution_l1"), (int) config("aikopanel.commission_distribution_l2"), (int) config("aikopanel.commission_distribution_l3")];
        } else {
            $_obfuscated_0D38231433253D3908263E04340B063703262321141F22_ = [100];
        }
        for ($_obfuscated_0D1B3E1C112F1F05223937183F04071628152C383E0211_ = 0; $_obfuscated_0D1B3E1C112F1F05223937183F04071628152C383E0211_ < $_obfuscated_0D35141407050F0A120F3D180C372F1F22082E37313C22_; $_obfuscated_0D1B3E1C112F1F05223937183F04071628152C383E0211_++) {
            $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_ = \App\Models\User::find($inviteUserId);
            if(!$_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_) {
            } elseif(!isset($_obfuscated_0D38231433253D3908263E04340B063703262321141F22_[$_obfuscated_0D1B3E1C112F1F05223937183F04071628152C383E0211_])) {
            } else {
                $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_ = $order->commission_balance * $_obfuscated_0D38231433253D3908263E04340B063703262321141F22_[$_obfuscated_0D1B3E1C112F1F05223937183F04071628152C383E0211_] / 100;
                if(!$_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_) {
                } else {
                    if((int) config("aikopanel.withdraw_close_enable", 0)) {
                        $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->balance = $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->balance + $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_;
                    } else {
                        $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->commission_balance = $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->commission_balance + $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_;
                    }
                    if(!$_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->save()) {
                        \Illuminate\Support\Facades\DB::rollBack();
                        return false;
                    }
                    if(!\App\Models\CommissionLog::create(["invite_user_id" => $inviteUserId, "user_id" => $order->user_id, "trade_no" => $order->trade_no, "order_amount" => $order->total_amount, "get_amount" => $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_])) {
                        \Illuminate\Support\Facades\DB::rollBack();
                        return false;
                    }
                    $inviteUserId = $_obfuscated_0D3938300C0519332D212540081737370F0A0A22243F32_->invite_user_id;
                    $order->actual_commission_balance = $order->actual_commission_balance + $_obfuscated_0D1E2F0E2E221B2E3C3E045B5B1B0E13251F2C402B1E01_;
                }
            }
        }
        return true;
    }
}

?>