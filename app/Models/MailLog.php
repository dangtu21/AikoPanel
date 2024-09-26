<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class MailLog extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_mail_log";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_EMAIL = "email";
    const FIELD_SUBJECT = "subject";
    const FIELD_TEMPLATE_NAME = "template_name";
    const FIELD_ERROR = "error";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>