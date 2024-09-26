<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class NoticeController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D063B331823155C242D325C2E280B2A1C152C285B2222_ = \App\Models\Notice::orderBy("id", "DESC")->get();
        $_obfuscated_0D230C1F130E26081D19010A39281A2426090403271D32_ = config("aikopanel.sub_domain") ?? [];
        $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_ = parse_url(config("aikopanel.app_url"))["host"] ?? "aikopanel.com";
        $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_ = [];
        $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_[] = ["id" => 0, "staff_url" => $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_];
        $_obfuscated_0D3C120D03183726221D2B1F2221212F192A252B214001_ = \App\Models\User::whereIn("staff_url", $_obfuscated_0D230C1F130E26081D19010A39281A2426090403271D32_)->get();
        foreach ($_obfuscated_0D3C120D03183726221D2B1F2221212F192A252B214001_ as $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_) {
            $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_[] = ["id" => $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_->id, "staff_url" => $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_->staff_url];
        }
        return response()->json(["data" => $_obfuscated_0D063B331823155C242D325C2E280B2A1C152C285B2222_, "staff" => $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_]);
    }
    public function save(\App\Http\Requests\Admin\NoticeSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $data = $request->only(["title", "content", "img_url", "tags", "staff_urls"]);
        if(!$request->input("id")) {
            if(!\App\Models\Notice::create($data)) {
                abort(500, "Lưu thất bại");
            }
        } else {
            try {
                \App\Models\Notice::find($request->input("id"))->update($data);
            } catch (\Exception $ex) {
                abort(500, "Lưu thất bại");
            }
        }
        return response(["data" => true]);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "ID không được để trống");
        }
        $_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_ = \App\Models\Notice::find($request->input("id"));
        if(!$_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_) {
            abort(500, "Không tìm thấy");
        }
        $_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_->show = $_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_->show ? 0 : 1;
        if(!$_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_->save()) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "ID không được để trống");
        }
        $_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_ = \App\Models\Notice::find($request->input("id"));
        if(!$_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_) {
            abort(500, "Không tìm thấy");
        }
        if(!$_obfuscated_0D190A142D0230140D150F342F40261F052E373E243701_->delete()) {
            abort(500, "Xóa thất bại");
        }
        return response(["data" => true]);
    }
}

?>