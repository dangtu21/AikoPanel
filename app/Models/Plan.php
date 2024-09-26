<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Plan extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_plan";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_GROUP_ID = "group_id";
    const FIELD_TRANSFER_ENABLE = "transfer_enable";
    const FIELD_NAME = "name";
    const FIELD_SPEED_LIMIT = "speed_limit";
    const FIELD_DEVICE_LIMIT = "device_limit";
    const FIELD_SHOW = "show";
    const FIELD_SORT = "sort";
    const FIELD_RENEW = "renew";
    const FIELD_CONTENT = "content";
    const FIELD_ONE_DAY_PRICE = "one_day_price";
    const FIELD_MONTH_PRICE = "month_price";
    const FIELD_TWO_MONTH_PRICE = "two_month_price";
    const FIELD_WEEK_PRICE = "week_price";
    const FIELD_QUARTER_PRICE = "quarter_price";
    const FIELD_HALF_YEAR_PRICE = "half_year_price";
    const FIELD_YEAR_PRICE = "year_price";
    const FIELD_TWO_YEAR_PRICE = "two_year_price";
    const FIELD_THREE_YEAR_PRICE = "three_year_price";
    const FIELD_ONETIME_PRICE = "onetime_price";
    const FIELD_RESET_PRICE = "reset_price";
    const FIELD_RESET_TRAFFIC_METHOD = "reset_traffic_method";
    const FIELD_CAPACITY_LIMIT = "capacity_limit";
    const FIELD_APPLEID_LIMIT = "appleid_limit";
    const FIELD_SNI = "sni";
    const FIELD_PLAN_TYPE = "plan_type";
    const FIELD_PLAN_OF_STAFF = "plan_of_staff";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>