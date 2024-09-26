<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Log extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_log";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_LEVEL = "level";
    const FIELD_HOST = "host";
    const FIELD_URI = "uri";
    const FIELD_METHOD = "method";
    const FIELD_DATA = "data";
    const FIELD_IP = "ip";
    const FIELD_CONTEXT = "context";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>