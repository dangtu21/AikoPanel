<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_user";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_INVITE_USER_ID = "invite_user_id";
    const FIELD_TELEGRAM_ID = "telegram_id";
    const FIELD_EMAIL = "email";
    const FIELD_USERNAME = "username";
    const FIELD_PASSWORD = "password";
    const FIELD_PASSWORD_ALGO = "password_algo";
    const FIELD_PASSWORD_SALT = "password_salt";
    const FIELD_BALANCE = "balance";
    const FIELD_DISCOUNT = "discount";
    const FIELD_COMMISSION_TYPE = "commission_type";
    const FIELD_COMMISSION_RATE = "commission_rate";
    const FIELD_COMMISSION_BALANCE = "commission_balance";
    const FIELD_T = "t";
    const FIELD_U = "u";
    const FIELD_D = "d";
    const FIELD_TRANSFER_ENABLE = "transfer_enable";
    const FIELD_BANNED = "banned";
    const FIELD_IS_ADMIN = "is_admin";
    const FIELD_LAST_LOGIN_AT = "last_login_at";
    const FIELD_IS_STAFF = "is_staff";
    const FIELD_STAFF_URL = "staff_url";
    const FIELD_LAST_LOGIN_IP = "last_login_ip";
    const FIELD_REGISTER_IP = "register_ip";
    const FIELD_UUID = "uuid";
    const FIELD_GROUP_ID = "group_id";
    const FIELD_PLAN_ID = "plan_id";
    const FIELD_RESET_TRAFFIC_METHOD = "reset_traffic_method";
    const FIELD_SPEED_LIMIT = "speed_limit";
    const FIELD_DEVICE_LIMIT = "device_limit";
    const FIELD_REMIND_EXPIRE = "remind_expire";
    const FIELD_REMIND_TRAFFIC = "remind_traffic";
    const FIELD_TOKEN = "token";
    const FIELD_AVATAR_URL = "avatar_url";
    const FIELD_EXPIRED_AT = "expired_at";
    const FIELD_REMARKS = "remarks";
    const FIELD_APPLEID_LIMIT = "appleid_limit";
    const FIELD_SNI = "sni";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>