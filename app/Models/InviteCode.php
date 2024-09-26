<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class InviteCode extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_invite_code";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_USER_ID = "user_id";
    const FIELD_CODE = "code";
    const FIELD_STATUS = "status";
    const FIELD_PV = "pv";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>