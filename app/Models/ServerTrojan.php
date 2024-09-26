<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Models;

class ServerTrojan extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "v2_server_trojan";
    protected $dateFormat = "U";
    protected $guarded = ["id"];
    protected $casts;
    const FIELD_ID = "id";
    const FIELD_GROUP_ID = "group_id";
    const FIELD_ROUTE_ID = "route_id";
    const FIELD_PARENT_ID = "parent_id";
    const FIELD_TAGS = "tags";
    const FIELD_ARRANGE_PRIORITY = "arrange_priority";
    const FIELD_SPEED_LIMIT = "speed_limit";
    const FIELD_NAME = "name";
    const FIELD_RATE = "rate";
    const FIELD_HOST = "host";
    const FIELD_IP = "ip";
    const FIELD_IPS = "ips";
    const FIELD_RECORD_ID = "record_id";
    const FIELD_PORT = "port";
    const FIELD_SERVER_PORT = "server_port";
    const FIELD_NETWORK = "\tnetwork";
    const FIELD_NETWORK_SETTINGS = "network_settings";
    const FIELD_ALLOW_INSECURE = "allow_insecure";
    const FIELD_SERVER_NAME = "server_name";
    const FIELD_SHOW = "show";
    const FIELD_REPORT = "report";
    const FIELD_SORT = "sort";
    const FIELD_CREATED_AT = "created_at";
    const FIELD_UPDATED_AT = "updated_at";
}

?>