<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class CouponController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_ = in_array($request->input("sort_type"), ["ASC", "DESC"]) ? $request->input("sort_type") : "DESC";
        $sort = $request->input("sort") ? $request->input("sort") : "id";
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\Coupon::orderBy($sort, $_obfuscated_0D1D281017240F221F26042714163F1E283403143E2A22_);
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->count();
        $_obfuscated_0D1C0140252612373234061910300A1031083916272E32_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return response(["data" => $_obfuscated_0D1C0140252612373234061910300A1031083916272E32_, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
    public function show(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "Tham số không hợp lệ");
        }
        $_obfuscated_0D37403615292425303202293313340537252F25123732_ = \App\Models\Coupon::find($request->input("id"));
        if(!$_obfuscated_0D37403615292425303202293313340537252F25123732_) {
            abort(500, "Không tìm thấy mã giảm giá");
        }
        $_obfuscated_0D37403615292425303202293313340537252F25123732_->show = $_obfuscated_0D37403615292425303202293313340537252F25123732_->show ? 0 : 1;
        if(!$_obfuscated_0D37403615292425303202293313340537252F25123732_->save()) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => true]);
    }
    public function generate(\App\Http\Requests\Admin\CouponGenerate $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        if($request->input("generate_count")) {
            $this->multiGenerate($request);
        } else {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validated();
            if(!$request->input("id")) {
                if(!isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["code"])) {
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["code"] = \App\Utils\Helper::randomChar(8);
                }
                if(!\App\Models\Coupon::create($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_)) {
                    abort(500, "Tạo thất bại");
                }
            } else {
                try {
                    \App\Models\Coupon::find($request->input("id"))->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
                } catch (\Exception $ex) {
                    abort(500, "Lưu thất bại");
                }
            }
            return response(["data" => true]);
        }
    }
    private function multiGenerate(\App\Http\Requests\Admin\CouponGenerate $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return abort(500, "License illegal Please contact https://t.me/Tele_Aiko to purchase copyright.");
        }
        $_obfuscated_0D1C0140252612373234061910300A1031083916272E32_ = [];
        $_obfuscated_0D37403615292425303202293313340537252F25123732_ = $request->validated();
        $_obfuscated_0D37403615292425303202293313340537252F25123732_["updated_at"] = time();
        $_obfuscated_0D37403615292425303202293313340537252F25123732_["created_at"] = $_obfuscated_0D37403615292425303202293313340537252F25123732_["updated_at"];
        $_obfuscated_0D37403615292425303202293313340537252F25123732_["show"] = 1;
        unset($_obfuscated_0D37403615292425303202293313340537252F25123732_["generate_count"]);
        for ($i = 0; $i < $request->input("generate_count"); $i++) {
            $_obfuscated_0D37403615292425303202293313340537252F25123732_["code"] = \App\Utils\Helper::randomChar(8);
            array_push($_obfuscated_0D1C0140252612373234061910300A1031083916272E32_, $_obfuscated_0D37403615292425303202293313340537252F25123732_);
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        if(!\App\Models\Coupon::insert(array_map(function ($item) use($item) {
            if(isset($item["limit_plan_ids"]) && is_array($item["limit_plan_ids"])) {
                $item["limit_plan_ids"] = json_encode($coupon["limit_plan_ids"]);
            }
            if(isset($item["limit_period"]) && is_array($item["limit_period"])) {
                $item["limit_period"] = json_encode($coupon["limit_period"]);
            }
            return $item;
        }, $_obfuscated_0D1C0140252612373234061910300A1031083916272E32_))) {
            \Illuminate\Support\Facades\DB::rollBack();
            abort(500, "Tạo thất bại");
        }
        \Illuminate\Support\Facades\DB::commit();
        $data = "Tên, Loại, Số tiền hoặc Tỷ lệ, Thời gian bắt đầu, Thời gian kết thúc, Số lần sử dụng, Sử dụng cho đăng ký, Mã voucher, Thời gian tạo\r\n";
        foreach ($_obfuscated_0D1C0140252612373234061910300A1031083916272E32_ as $coupon) {
            $type = ["", "Số tiền", "Tỷ lệ"][$coupon["type"]];
            $value = ["", $coupon["value"] / 100, $coupon["value"]][$coupon["type"]];
            $_obfuscated_0D28093C38245B360903403E0C2F2B2A291E401D291C22_ = date("d-m-Y H:i:s", $coupon["started_at"]);
            $_obfuscated_0D5C3F242D1F2A25171035235C060D130B3C210E151D22_ = date("d-m-Y H:i:s", $coupon["ended_at"]);
            $_obfuscated_0D31025C12331F021A18211325371C0E310603340A0311_ = $coupon["limit_use"] ?? "Không giới hạn";
            $_obfuscated_0D0A13093C3F233F1E2E2B3B220732351202022C2E3822_ = date("d-m-Y H:i:s", $coupon["created_at"]);
            $_obfuscated_0D21260C2B3018231C11312622020F2B13381D2F2A3811_ = isset($coupon["limit_plan_ids"]) ? implode("/", $coupon["limit_plan_ids"]) : "Không giới hạn";
            $_obfuscated_0D300504280528023E13091D1B2E3D3C312C191F2C0E22_ = isset($coupon["limit_staff_urls"]) ? implode("/", $coupon["limit_staff_urls"]) : "Không giới hạn";
            $data .= $coupon["name"] . "," . $type . "," . $value . "," . $_obfuscated_0D28093C38245B360903403E0C2F2B2A291E401D291C22_ . "," . $_obfuscated_0D5C3F242D1F2A25171035235C060D130B3C210E151D22_ . "," . $_obfuscated_0D31025C12331F021A18211325371C0E310603340A0311_ . "," . $_obfuscated_0D21260C2B3018231C11312622020F2B13381D2F2A3811_ . "," . $coupon["code"] . "," . $_obfuscated_0D0A13093C3F233F1E2E2B3B220732351202022C2E3822_ . "," . $_obfuscated_0D300504280528023E13091D1B2E3D3C312C191F2C0E22_ . "\r\n";
        }
        echo $data;
    }
    public function drop(\Illuminate\Http\Request $request)
    {
        if(!$request->input("id")) {
            abort(500, "Tham số không hợp lệ");
        }
        $coupon = \App\Models\Coupon::find($request->input("id"));
        if(!$coupon) {
            abort(500, "Không tìm thấy mã giảm giá");
        }
        if(!$coupon->delete()) {
            abort(500, "Xóa thất bại");
        }
        return response(["data" => true]);
    }
}

?>