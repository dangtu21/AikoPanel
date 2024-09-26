<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff\Server;

class GroupController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        if($request->input("group_id")) {
            return response(["data" => [\App\Models\ServerGroup::find($request->input("group_id"))]]);
        }
        $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_ = \App\Models\ServerGroup::get();
        $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_ = new \App\Services\ServerService();
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_->getAllServers();
        foreach ($_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_[$k]["user_count"] = \App\Models\User::where("group_id", $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"])->count();
            $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_[$k]["server_count"] = 0;
            foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                if(in_array($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_["id"], $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["group_id"])) {
                    $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_[$k]["server_count"] = $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_[$k]["server_count"] + 1;
                }
            }
        }
        return response(["data" => $_obfuscated_0D33321D012F1501272F39013436231C011C06063F1722_]);
    }
}

?>