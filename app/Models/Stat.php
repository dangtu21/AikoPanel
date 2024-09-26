<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Stat extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_stat";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_RECORD_AT = "record_at";
    const FIELD_RECORD_TYPE = "record_type";
    const FIELD_ORDER_COUNT = "order_count";
    const FIELD_ORDER_TOTAL = "order_total";
    const FIELD_COMMISSION_COUNT = "commission_count";
    const FIELD_COMMISSION_TOTAL = "commission_total";
    const FIELD_PAID_COUNT = "paid_count";
    const FIELD_PAID_TOTAL = "paid_total";
    const FIELD_REGISTER_COUNT = "register_count";
    const FIELD_INVITE_COUNT = "invite_count";
    const FIELD_TRANSFER_USED_TOTAL = "transfer_used_total";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>