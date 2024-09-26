<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
$uri = urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
if($uri !== "/" && file_exists(__DIR__ . "/public" . $uri)) {
    return false;
}
require_once __DIR__ . "/public/index.php";

?>