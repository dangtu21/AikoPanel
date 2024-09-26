<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class ServerController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::find($request->user["id"]);
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = [];
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        if($_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user)) {
            $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_ = new \App\Services\ServerService();
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_->getAvailableServers($user);
        }
        $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ = sha1(json_encode(array_column($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, "cache_key")));
        if(strpos($request->header("If-None-Match"), $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_) !== false) {
            abort(304);
        }
        return response(["data" => $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_])->header("ETag", "\"" . $_obfuscated_0D2F0815300C3F290C2F2D3C2D10163F2C22183C032F11_ . "\"");
    }
}

?>