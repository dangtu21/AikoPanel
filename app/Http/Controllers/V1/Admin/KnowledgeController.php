<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class KnowledgeController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D230C1F130E26081D19010A39281A2426090403271D32_ = config("aikopanel.sub_domain") ?? [];
        $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_ = parse_url(config("aikopanel.app_url"))["host"] ?? "aikopanel.com";
        $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_ = [];
        $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_[] = ["id" => 0, "url" => $_obfuscated_0D073C1B34241C33252C330F232F12051A183B2A3D3411_];
        $_obfuscated_0D3C120D03183726221D2B1F2221212F192A252B214001_ = \App\Models\User::whereIn("staff_url", $_obfuscated_0D230C1F130E26081D19010A39281A2426090403271D32_)->get();
        foreach ($_obfuscated_0D3C120D03183726221D2B1F2221212F192A252B214001_ as $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_) {
            $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_[] = ["id" => $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_->id, "url" => $_obfuscated_0D0F31333C5C2C3F191D0D2B281501212D340933373401_->staff_url];
        }
        if($request->input("id")) {
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_ = \App\Models\Knowledge::find($request->input("id"))->toArray();
            if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_) {
                abort(500, "Không có kiến thức về điều này.");
            }
            return response(["data" => $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_]);
        }
        return response(["data" => \App\Models\Knowledge::select(["title", "id", "updated_at", "category", "staff_urls", "show"])->orderBy("sort", "ASC")->get(), "staff" => $_obfuscated_0D030B0B3533032F0B073E075B3B2A1D2B36020A070C11_]);
    }
    public function getCategory(\Illuminate\Http\Request $request)
    {
        return response(["data" => array_keys(\App\Models\Knowledge::get()->groupBy("category")->toArray())]);
    }
    public function save(\App\Http\Requests\Admin\KnowledgeSave $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
        if(!$request->input("id")) {
            if(!\App\Models\Knowledge::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
                abort(500, "Tạo thất bại");
            }
        } else {
            try {
                \App\Models\Knowledge::find($request->input("id"))->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
            } catch (\Exception $ex) {
                abort(500, "Lưu thất bại");
            }
        }
        return response(["data" => true]);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "ID không hợp lệ");
        }
        $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_ = \App\Models\Knowledge::find($request->input("id"));
        if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_) {
            abort(500, "Không tìm thấy kiến thức");
        }
        $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->show = $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->show ? 0 : 1;
        if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->save()) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function sort(\App\Http\Requests\Admin\KnowledgeSort $request)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            foreach ($request->input("knowledge_ids") as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
                $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_ = \App\Models\Knowledge::find($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_);
                $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->timestamps = false;
                $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->update(["sort" => $k + 1]);
            }
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, "Lưu thất bại");
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "ID không hợp lệ");
        }
        $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_ = \App\Models\Knowledge::find($request->input("id"));
        if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_) {
            abort(500, "Không tìm thấy kiến thức");
        }
        if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_->delete()) {
            abort(500, "Xóa thất bại");
        }
        return response(["data" => true]);
    }
}

?>