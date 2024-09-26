<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Sni extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_sni";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_LABLE = "label";
    const FIELD_VALUE = "value";
    const FIELD_ABBREVIATION = "abbreviation";
    const FIELD_CONTENT = "content";
    const FIELD_SHOW = "show";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>