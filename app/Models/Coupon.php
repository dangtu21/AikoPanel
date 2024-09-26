<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Coupon extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_coupon";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_CODE = "code";
    const FIELD_NAME = "name";
    const FIELD_TYPE = "type";
    const FIELD_VALUE = "value";
    const FIELD_SHOW = "show";
    const FIELD_LIMIT_USE = "limit_use";
    const FIELD_LIMIT_USE_WITH_USER = "limit_use_with_user";
    const FIELD_LIMIT_PLAN_IDS = "limit_plan_ids";
    const FIELD_LIMIT_PERIOD = "limit_period";
    const FIELD_LIMIT_STAFF_URLS = "limit_staff_urls";
    const FIELD_STARTED_AT = "started_at";
    const FIELD_ENDED_AT = "ended_at";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>