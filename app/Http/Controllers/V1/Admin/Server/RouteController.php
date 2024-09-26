<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin\Server;

class RouteController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D302403173E1801152A30012622364004283023350E32_ = \App\Models\ServerRoute::get();
        foreach ($_obfuscated_0D302403173E1801152A30012622364004283023350E32_ as $k => $_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_) {
            $array = json_decode($_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_->match, true);
            if(is_array($array)) {
                $_obfuscated_0D302403173E1801152A30012622364004283023350E32_[$k]["match"] = $array;
            }
        }
        return ["data" => $_obfuscated_0D302403173E1801152A30012622364004283023350E32_];
    }
    public function save(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validate(["remarks" => "required", "match" => "required|array", "action" => "required|in:block,dns", "action_value" => "nullable"], ["remarks.required" => "Chú thích không được để trống", "match.required" => "Điều kiện không được để trống", "action.required" => "Hành động không được để trống", "action.in" => "Hành động không hợp lệ"]);
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["match"] = array_filter($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["match"]);
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["match"] = json_encode($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["match"]);
        if($request->input("id")) {
            try {
                $_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_ = \App\Models\ServerRoute::find($request->input("id"));
                $_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
                return ["data" => true];
            } catch (\Exception $ex) {
                abort(500, "Lưu thất bại");
            }
        }
        if(!\App\Models\ServerRoute::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
            abort(500, "Tạo thất bại");
        }
        return ["data" => true];
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_ = \App\Models\ServerRoute::find($request->input("id"));
        if(!$_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_) {
            abort(500, "ID của nút không tồn tại.");
        }
        if(!$_obfuscated_0D15282B0C230C3013363C31260E05242D2B120F082C11_->delete()) {
            abort(500, "Xóa thất bại");
        }
        return ["data" => true];
    }
}

?>