<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class SniController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        return response(["data" => \App\Models\Sni::orderBy("id", "DESC")->get()]);
    }
    public function save(\App\Http\Requests\Admin\SniSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $data = $request->only(["label", "value", "abbreviation", "content"]);
        if(!$request->input("id")) {
            if(!\App\Models\Sni::create($data)) {
                abort(500, "Lưu không thành công");
            }
        } else {
            try {
                \App\Models\Sni::find($request->input("id"))->update($data);
            } catch (\Exception $ex) {
                abort(500, "Lưu không thành công");
            }
        }
        return response(["data" => true]);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "Tham số sai");
        }
        $Sni = \App\Models\Sni::find($request->input("id"));
        if(!$Sni) {
            abort(500, "Sni không tồn tại");
        }
        $Sni->show = $Sni->show ? 0 : 1;
        if(!$Sni->save()) {
            abort(500, "Lưu không thành công");
        }
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "Lỗi tham số");
        }
        $Sni = \App\Models\Sni::find($request->input("id"));
        if(!$Sni) {
            abort(500, "Sni không tồn tại");
        }
        if(!$Sni->delete()) {
            abort(500, "Xóa không thành công");
        }
        return response(["data" => true]);
    }
}

?>