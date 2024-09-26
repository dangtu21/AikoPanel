<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Payment extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_payment";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_UUID = "uuid";
    const FIELD_PAYMENT = "payment";
    const FIELD_NAME = "name";
    const FIELD_STAFF_URLS = "staff_urls";
    const FIELD_ICON = "icon";
    const FIELD_CONFIG = "config";
    const FIELD_NOTIFY_DOMAIN = "notify_domain";
    const FIELD_HANDLING_FEE_FIXED = "handling_fee_fixed";
    const FIELD_HANDLING_FEE_PERCENT = "handling_fee_percent";
    const FIELD_ENABLE = "enable";
    const FIELD_SORT = "sort";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>