<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class UserUpdate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["email" => "required|email:strict", "password" => "nullable|min:8", "transfer_enable" => "numeric", "device_limit" => "nullable|integer", "appleid_limit" => "nullable|integer", "sni" => "nullable", "expired_at" => "nullable|integer", "banned" => "required|in:0,1", "plan_id" => "nullable|integer", "commission_rate" => "nullable|integer|min:0|max:100", "discount" => "nullable|integer|min:0|max:100", "is_admin" => "required|in:0,1", "is_staff" => "required|in:0,1", "staff_url" => "nullable", "telegram_id" => "nullable", "u" => "integer", "d" => "integer", "balance" => "integer", "commission_type" => "integer", "commission_balance" => "integer", "remarks" => "nullable", "speed_limit" => "nullable|integer", "reset_traffic_method" => "nullable|in:0,1,2,3,4,5"];
    }
    public function messages()
    {
        return ["email.required" => "E-mail không thể trống", "email.email" => "Định dạng E-mail không đúng", "transfer_enable.numeric" => "Định dạng băng thông không đúng", "device_limit.integer" => "Định dạng giới hạn thiết bị không đúng", "appleid_limit.integer" => "Định dạng giới hạn Apple ID không đúng", "expired_at.integer" => "Định dạng ngày hết hạn không đúng", "banned.required" => "Trạng thái cấm không thể trống", "banned.in" => "Định dạng trạng thái cấm không đúng", "is_admin.required" => "Trạng thái quản trị viên không thể trống", "is_admin.in" => "Định dạng trạng thái quản trị viên không đúng", "is_staff.required" => "Trạng thái nhân viên không thể trống", "is_staff.in" => "Định dạng trạng thái nhân viên không đúng", "plan_id.integer" => "Định dạng ID gói không đúng", "commission_rate.integer" => "Định dạng tỷ lệ hoa hồng không đúng", "commission_rate.nullable" => "Định dạng tỷ lệ hoa hồng không đúng", "commission_rate.min" => "Tỷ lệ hoa hồng tối thiểu là 0", "commission_rate.max" => "Tỷ lệ hoa hồng tối đa là 100", "discount.integer" => "Định dạng tỷ lệ giảm giá không đúng", "discount.nullable" => "Định dạng tỷ lệ giảm giá không đúng", "discount.min" => "Tỷ lệ giảm giá tối thiểu là 0", "discount.max" => "Tỷ lệ giảm giá tối đa là 100", "u.integer" => "Định dạng lưu lượng truy cập không đúng", "d.integer" => "Định dạng lưu lượng tải xuống không đúng", "balance.integer" => "Định dạng số dư không đúng", "commission_balance.integer" => "Định dạng số dư hoa hồng không đúng", "password.min" => "Mật khẩu tối thiểu là 8 ký tự", "speed_limit.integer" => "Định dạng giới hạn tốc độ không đúng", "reset_traffic_method.in" => "Định dạng phương pháp đặt lại lưu lượng không đúng", "staff_url.url" => "Định dạng URL nhân viên không đúng", "staff_logo.url" => "Định dạng URL logo nhân viên không đúng", "staff_zalo.url" => "Định dạng URL Zalo nhân viên không đúng", "staff_telegram.url" => "Định dạng URL Telegram nhân viên không đúng"];
    }
}

?>