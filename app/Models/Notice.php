<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class Notice extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_notice";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_TITLE = "title";
    const FIELD_CONTENT = "content";
    const FIELD_SHOW = "show";
    const FIELD_IMG_URL = "img_url";
    const FIELD_TAGS = "tags";
    const FIELD_STAFF_URLS = "staff_urls";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>