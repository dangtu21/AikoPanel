<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Order extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_order";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_INVITE_USER_ID = "invite_user_id";
    const FIELD_USER_ID = "user_id";
    const FIELD_PLAN_ID = "plan_id";
    const FIELD_COUPON_ID = "coupon_id";
    const FIELD_PAYMENT_ID = "payment_id";
    const FIELD_TYPE = "type";
    const FIELD_PERIOD = "period";
    const FIELD_TRADE_NO = "trade_no";
    const FIELD_CALLBACK_NO = "callback_no";
    const FIELD_TOTAL_AMOUNT = "total_amount";
    const FIELD_HANDLING_AMOUNT = "handling_amount";
    const FIELD_DISCOUNT_AMOUNT = "discount_amount";
    const FIELD_SURPLUS_AMOUNT = "surplus_amount";
    const FIELD_REFUND_AMOUNT = "refund_amount";
    const FIELD_BALANCE_AMOUNT = "balance_amount";
    const FIELD_SURPLUS_ORDER_IDS = "surplus_order_ids";
    const FIELD_STATUS = "status";
    const FIELD_COMMISSION_STATUS = "commission_status";
    const FIELD_COMMISSION_BALANCE = "commission_balance";
    const FIELD_ACTUAL_COMMISSION_BALANCE = "actual_commission_balance";
    const FIELD_PAID_AT = "paid_at";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
    const CALLBACK_NO_MANUAL_OPERATION = "manual_operation";
    const FIELD_ONETIME_PRICE = NULL;
    const FIELD_RESET_PRICE = NULL;
    const STATUS_UNPAID = 0;
    const STATUS_PENDING = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_DISCOUNTED = 4;
    const TYPE_NEW = 1;
    const TYPE_RENEW = 2;
    const TYPE_CHANGE = 3;
    const TYPE_RESET_PRICE = 4;
    const TYPE_ONETIME = 5;
    const TYPE_RECHARGE = 6;
}

?>