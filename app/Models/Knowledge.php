<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Knowledge extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_knowledge";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_LANGUAGE = "language";
    const FIELD_CATEGORY = "category";
    const FIELD_STAFF_URLS = "staff_urls";
    const FIELD_TITLE = "title";
    const FIELD_BODY = "body";
    const FIELD_SORT = "sort";
    const FIELD_SHOW = "show";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>