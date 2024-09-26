<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class PaymentController extends \App\Http\Controllers\Controller
{
    public function getPaymentMethods()
    {
        $_obfuscated_0D371002122D1A313C0E281828102E24160B183B010701_ = [];
        foreach (glob(base_path("app//Payments") . "/*.php") as $file) {
            array_push($_obfuscated_0D371002122D1A313C0E281828102E24160B183B010701_, pathinfo($file)["filename"]);
        }
        return response(["data" => $_obfuscated_0D371002122D1A313C0E281828102E24160B183B010701_]);
    }
    public function fetch()
    {
        $_obfuscated_0D14185C24262D1B031B2C27153D3D03315C0D33303C32_ = \App\Models\Payment::orderBy("sort", "ASC")->get();
        foreach ($_obfuscated_0D14185C24262D1B031B2C27153D3D03315C0D33303C32_ as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_ = url("/api/v1/guest/payment/notify/" . $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_->payment . "/" . $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_->uuid);
            if($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_->notify_domain) {
                $_obfuscated_0D2A3C1F2C13243B333527173C3219150B5B1711092E01_ = parse_url($_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_);
                $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_ = $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_->notify_domain . $_obfuscated_0D2A3C1F2C13243B333527173C3219150B5B1711092E01_["path"];
            }
            $_obfuscated_0D14185C24262D1B031B2C27153D3D03315C0D33303C32_[$k]["notify_url"] = $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_;
        }
        return response(["data" => $_obfuscated_0D14185C24262D1B031B2C27153D3D03315C0D33303C32_]);
    }
    public function getPaymentForm(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_ = new \App\Services\PaymentService($request->input("payment"), $request->input("id"));
        return response(["data" => $_obfuscated_0D1F222118130A2B1E5B0D0C112E35050418360C150332_->form()]);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        $payment = \App\Models\Payment::find($request->input("id"));
        if(!$payment) {
            abort(500, "Phương thức thanh toán không tồn tại");
        }
        $payment->enable = !$payment->enable;
        if(!$payment->save()) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function save(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if(!config("aikopanel.app_url")) {
            abort(500, "Vui lòng cấu hình địa chỉ trang web trong cài đặt trang web");
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validate(["name" => "required", "staff_urls" => "nullable", "icon" => "nullable", "payment" => "required", "config" => "required", "notify_domain" => "nullable|url", "handling_fee_fixed" => "nullable|integer", "handling_fee_percent" => "nullable|numeric|between:0.1,100"], ["name.required" => "Tên không được để trống", "payment.required" => "Phương thức thanh toán không được để trống", "config.required" => "Cấu hình không được để trống", "notify_domain.url" => "Địa chỉ thông báo không hợp lệ", "handling_fee_fixed.integer" => "Phí cố định phải là số nguyên", "handling_fee_percent.between" => "Phí phần trăm phải nằm trong khoảng 0.1 đến 100"]);
        if($request->input("id")) {
            $payment = \App\Models\Payment::find($request->input("id"));
            if(!$payment) {
                abort(500, "Phương thức thanh toán không tồn tại");
            }
            try {
                $payment->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
            } catch (\Exception $ex) {
                abort(500, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
            }
            return response(["data" => true]);
        }
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["uuid"] = \App\Utils\Helper::randomChar(8);
        if(!\App\Models\Payment::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        $payment = \App\Models\Payment::find($request->input("id"));
        if(!$payment) {
            abort(500, "Phương thức thanh toán không tồn tại");
        }
        return response(["data" => $payment->delete()]);
    }
    public function sort(\Illuminate\Http\Request $request)
    {
        $request->validate(["ids" => "required|array"], ["ids.required" => "Tham số không hợp lệ", "ids.array" => "Tham số không hợp lệ"]);
        \Illuminate\Support\Facades\DB::beginTransaction();
        foreach ($request->input("ids") as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!\App\Models\Payment::find($_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_)->update(["sort" => $k + 1])) {
                \Illuminate\Support\Facades\DB::rollBack();
                abort(500, "Lưu thất bại");
            }
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => true]);
    }
}

?>