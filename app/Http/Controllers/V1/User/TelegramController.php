<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class TelegramController extends \App\Http\Controllers\Controller
{
    public function getBotInfo()
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->getMe();
        return response(["data" => ["username" => $response->result->username]]);
    }
    public function unbind(\Illuminate\Http\Request $request)
    {
        $user = \App\Models\User::where("user_id", $request->user["id"])->first();
    }
}

?>