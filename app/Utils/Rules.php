<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Utils;

class Rules
{
    public static function getIpBlockList()
    {
        $_obfuscated_0D1F2E393038112C231C18291E0B1E252618041F0F1B01_ = config("aikopanel.ip_blocklist");
        return $_obfuscated_0D1F2E393038112C231C18291E0B1E252618041F0F1B01_ ? explode(",", $_obfuscated_0D1F2E393038112C231C18291E0B1E252618041F0F1B01_) : [];
    }
    public static function getUABlockList()
    {
        $_obfuscated_0D381528060A0F2D1A1B401D04051F1A370D2509123201_ = config("aikopanel.ua_blocklist");
        return $_obfuscated_0D381528060A0F2D1A1B401D04051F1A370D2509123201_ ? explode("|", $_obfuscated_0D381528060A0F2D1A1B401D04051F1A370D2509123201_) : [];
    }
    public static function getCountryAllowList()
    {
        $_obfuscated_0D2936180E1B5B2D130708092935290B21222B0F3C0F01_ = config("aikopanel.country_allowlist");
        return $_obfuscated_0D2936180E1B5B2D130708092935290B21222B0F3C0F01_ ? explode(",", $_obfuscated_0D2936180E1B5B2D130708092935290B21222B0F3C0F01_) : [];
    }
    public static function getIpPriorityList()
    {
        $_obfuscated_0D395B0316291E4021123003403E2902062D1714311001_ = config("aikopanel.ip_prioritylist");
        return $_obfuscated_0D395B0316291E4021123003403E2902062D1714311001_ ? explode(",", $_obfuscated_0D395B0316291E4021123003403E2902062D1714311001_) : [];
    }
}

?>