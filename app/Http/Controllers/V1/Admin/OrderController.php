<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class OrderController extends \App\Http\Controllers\Controller
{
    private function filter(\Illuminate\Http\Request $request, &$builder)
    {
        if($request->input("filter")) {
            foreach ($request->input("filter") as $filter) {
                if($filter["key"] === "email") {
                    $user = \App\Models\User::where("email", "%" . $filter["value"] . "%")->first();
                    if(!$user) {
                    } else {
                        $builder->where("user_id", $user->id);
                    }
                } else {
                    if($filter["condition"] === "~") {
                        $filter["condition"] = "like";
                        $filter["value"] = "%" . $filter["value"] . "%";
                    }
                    $builder->where($filter["key"], $filter["condition"], $filter["value"]);
                }
            }
        }
    }
    public function detail(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::find($request->input("id"));
        $_obfuscated_0D220F0329062E151F1613280E081A0D140D2B300E2911_ = \App\Models\Coupon::where("id", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->coupon_id)->first();
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["coupon_name"] = $_obfuscated_0D220F0329062E151F1613280E081A0D140D2B300E2911_["name"] ?? NULL;
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, "Đơn hàng không tồn tại");
        }
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["commission_log"] = \App\Models\CommissionLog::where("trade_no", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no)->get();
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->surplus_order_ids) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_["surplus_orders"] = \App\Models\Order::whereIn("id", $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->surplus_order_ids)->get();
        }
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_]);
    }
    public function fetch(\App\Http\Requests\Admin\OrderFetch $request)
    {
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("pageSize") ? $request->input("pageSize") : 10;
        $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_ = \App\Models\Order::orderBy("created_at", "DESC");
        if($request->input("is_commission")) {
            $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->where("invite_user_id", "!=", NULL);
            $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->whereNotIn("status", [0, 2]);
            $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->where("commission_balance", ">", 0);
        }
        $this->filter($request, $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_);
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->count();
        $res = $_obfuscated_0D042D010812170C5B0C0F3F225C0E2C393E121F023301_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::get();
        $_obfuscated_0D37403615292425303202293313340537252F25123732_ = \App\Models\Coupon::get();
        for ($i = 0; $i < count($res); $i++) {
            for ($k = 0; $k < count($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_); $k++) {
                if($_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["id"] == $res[$i]["plan_id"]) {
                    $res[$i]["plan_name"] = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_[$k]["name"];
                    break;
                }
            }
            $res[$i]["coupon_name"] = NULL;
            for ($k = 0; $k < count($_obfuscated_0D37403615292425303202293313340537252F25123732_); $k++) {
                if($_obfuscated_0D37403615292425303202293313340537252F25123732_[$k]["id"] == $res[$i]["coupon_id"]) {
                    $res[$i]["coupon_name"] = $_obfuscated_0D37403615292425303202293313340537252F25123732_[$k]["name"];
                    break;
                }
            }
        }
        return response(["data" => $res, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
    public function paid(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $request->input("trade_no"))->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, "Đơn hàng không tồn tại");
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status !== 0 && $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status !== 2) {
            abort(500, "Chỉ có thể thực hiện thao tác trên đơn hàng chưa thanh toán");
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        if(!$_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->paid("manual_operation")) {
            abort(500, "Cập nhật thất bại");
        }
        return response(["data" => true]);
    }
    public function cancel(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $request->input("trade_no"))->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, "Đơn hàng không tồn tại");
        }
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->status !== 0) {
            abort(500, "Chỉ có thể thực hiện thao tác trên đơn hàng chưa thanh toán");
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        if(!$_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->cancel()) {
            abort(500, "Cập nhật thất bại");
        }
        return response(["data" => true]);
    }
    public function update(\App\Http\Requests\Admin\OrderUpdate $request)
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->only(["commission_status"]);
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::where("trade_no", $request->input("trade_no"))->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            abort(500, "Đơn hàng không tồn tại");
        }
        try {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->update($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        } catch (\Exception $ex) {
            abort(500, "Cập nhật thất bại");
        }
        return response(["data" => true]);
    }
    public function assign(\App\Http\Requests\Admin\OrderAssign $request)
    {
        $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_ = \App\Models\Plan::find($request->input("plan_id"));
        $user = \App\Models\User::where("email", $request->input("email"))->first();
        if(!$user) {
            abort(500, "Người dùng này không tồn tại");
        }
        if(!$_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_) {
            abort(500, "Gói này không tồn tại");
        }
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        if($_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isNotCompleteOrderByUserId($user->id)) {
            abort(500, "Người dùng này vẫn còn đơn hàng chưa thanh toán, không thể phân công");
        }
        \Illuminate\Support\Facades\DB::beginTransaction();
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = new \App\Models\Order();
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_);
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->user_id = $user->id;
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id = $_obfuscated_0D301810151324125C34231D1011082F0B2414010D1D11_->id;
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->period = $request->input("period");
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no = \App\Utils\Helper::guid();
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->total_amount = $request->input("total_amount");
        if($_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->period === "reset_price") {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->type = 4;
        } elseif($user->plan_id !== NULL && $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id !== $user->plan_id) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->type = 3;
        } elseif(time() < $user->expired_at && $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->plan_id == $user->plan_id) {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->type = 2;
        } else {
            $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->type = 1;
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->setInvite($user);
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->save()) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, "Tạo đơn hàng thất bại");
        }
        \Illuminate\Support\Facades\DB::commit();
        return response(["data" => $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_->trade_no]);
    }
}

?>