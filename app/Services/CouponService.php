<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class CouponService
{
    public $coupon;
    public $planId;
    public $userId;
    public $period;
    public function __construct($code)
    {
        $this->coupon = \App\Models\Coupon::where("code", $code)->lockForUpdate()->first();
    }
    public function use($order)
    {
        $this->setPlanId($order->plan_id);
        $this->setUserId($order->user_id);
        $this->setPeriod($order->period);
        $this->check();
        switch ($this->coupon->type) {
            case 1:
                $order->discount_amount = $this->coupon->value;
                break;
            case 2:
                $order->discount_amount = $order->total_amount * $this->coupon->value / 100;
                break;
            default:
                if($order->total_amount < $order->discount_amount) {
                    $order->discount_amount = $order->total_amount;
                }
                if($this->coupon->limit_use !== NULL) {
                    if($this->coupon->limit_use <= 0) {
                        return false;
                    }
                    $this->coupon->limit_use = $this->coupon->limit_use - 1;
                    if(!$this->coupon->save()) {
                        return false;
                    }
                }
                return true;
        }
    }
    public function getId()
    {
        return $this->coupon->id;
    }
    public function getCoupon()
    {
        return $this->coupon;
    }
    public function setPlanId($planId)
    {
        $this->planId = $planId;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setPeriod($period)
    {
        $this->period = $period;
    }
    public function checkLimitUseWithUser()
    {
        $_obfuscated_0D30112D0B39022E2B3E1B3E160A322610170E211F3D01_ = \App\Models\Order::where("coupon_id", $this->coupon->id)->where("user_id", $this->userId)->whereNotIn("status", [0, 2])->count();
        if($this->coupon->limit_use_with_user <= $_obfuscated_0D30112D0B39022E2B3E1B3E160A322610170E211F3D01_) {
            return false;
        }
        return true;
    }
    public function check()
    {
        if(!$this->coupon || !$this->coupon->show) {
            abort(500, __("Invalid coupon"));
        }
        if($this->coupon->limit_use <= 0 && $this->coupon->limit_use !== NULL) {
            abort(500, __("This coupon is no longer available"));
        }
        if(time() < $this->coupon->started_at) {
            abort(500, __("This coupon has not yet started"));
        }
        if($this->coupon->ended_at < time()) {
            abort(500, __("This coupon has expired"));
        }
        if($this->coupon->limit_plan_ids && $this->planId && !in_array($this->planId, $this->coupon->limit_plan_ids)) {
            abort(500, __("The coupon code cannot be used for this subscription"));
        }
        if($this->coupon->limit_period && $this->period && !in_array($this->period, $this->coupon->limit_period)) {
            abort(500, __("The coupon code cannot be used for this period"));
        }
        if($this->coupon->limit_use_with_user !== NULL && $this->userId && !$this->checkLimitUseWithUser()) {
            abort(500, __("The coupon can only be used :limit_use_with_user per person", ["limit_use_with_user" => $this->coupon->limit_use_with_user]));
        }
        if($this->coupon->limit_staff_urls) {
            $url = request()->server("HTTP_HOST");
            if(!in_array($url, $this->coupon->limit_staff_urls)) {
                abort(500, __("Invalid coupon"));
            }
        }
    }
}

?>