<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class NoticeController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $url = $request->server("HTTP_HOST");
        $current = $request->input("current") ?: 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 5;
        $user = \App\Models\User::where("staff_url", $url)->first();
        $_obfuscated_0D16262536051522152E073E3107080D323C27072F2D01_ = strval($user->id ?? 0);
        $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_ = \App\Models\Notice::orderBy("created_at", "DESC")->where("show", 1)->where(function ($query) use($query) {
            $query->whereJsonContains("staff_urls", $idstaff)->orWhereNull("staff_urls");
        });
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->count();
        $res = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return response(["data" => $res, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
}

?>