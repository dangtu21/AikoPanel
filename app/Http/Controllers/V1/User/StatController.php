<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class StatController extends \App\Http\Controllers\Controller
{
    public function getTrafficLog(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\StatUser::select(["u", "d", "record_at", "user_id", "server_rate"])->where("user_id", $request->user["id"])->where("record_at", ">=", strtotime(date("1-m-Y")))->orderBy("record_at", "DESC");
        return response(["data" => $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->get()]);
    }
}

?>