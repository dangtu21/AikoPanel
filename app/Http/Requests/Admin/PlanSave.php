<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class PlanSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["name" => "required", "content" => "", "group_id" => "required", "transfer_enable" => "required", "one_day_price" => "nullable|integer", "month_price" => "nullable|integer", "two_month_price" => "nullable|integer", "week_price" => "nullable|integer", "quarter_price" => "nullable|integer", "half_year_price" => "nullable|integer", "year_price" => "nullable|integer", "two_year_price" => "nullable|integer", "three_year_price" => "nullable|integer", "onetime_price" => "nullable|integer", "reset_price" => "nullable|integer", "reset_traffic_method" => "nullable|integer|in:0,1,2,3,4,5", "capacity_limit" => "nullable|integer", "speed_limit" => "nullable|integer", "device_limit" => "nullable|integer", "appleid_limit" => "nullable|integer", "sni" => "nullable", "plan_type" => "nullable|integer|in:1,2,3", "plan_of_staff" => "nullable|array"];
    }
    public function messages()
    {
        return ["name.required" => "Tên không được để trống", "type.required" => "Loại gói không được để trống", "type.in" => "Loại gói không hợp lệ", "group_id.required" => "Nhóm không được để trống", "transfer_enable.required" => "Băng thông không được để trống", "device_limit.integer" => "Số lượng thiết bị không hợp lệ", "appleid_limit.integer" => "Số lần lấy Apple ID không hợp lệ", "one_day_price.integer" => "Một ngày không hợp lệ", "month_price.integer" => "Tháng không hợp lệ", "week_price.integer" => "Tuần không hợp lệ", "two_month_price.integer" => "Hai tháng không hợp lệ", "quarter_price.integer" => "Quý không hợp lệ", "half_year_price.integer" => "Nửa năm không hợp lệ", "year_price.integer" => "Năm không hợp lệ", "two_year_price.integer" => "Hai năm không hợp lệ", "three_year_price.integer" => "Ba năm không hợp lệ", "onetime_price.integer" => "Một lần không hợp lệ", "reset_price.integer" => "Giá khôi phục không hợp lệ", "reset_traffic_method.integer" => "Định dạng phương pháp khôi phục lưu lượng không hợp lệ", "reset_traffic_method.in" => "Định dạng phương pháp khôi phục lưu lượng không hợp lệ", "capacity_limit.integer" => "Giới hạn dung lượng không hợp lệ", "speed_limit.integer" => "Giới hạn tốc độ không hợp lệ", "plan_type.integer" => "Loại gói không hợp lệ", "plan_type.in" => "Loại gói không hợp lệ", "plan_of_staff.array" => "Định dạng nhân viên không hợp lệ"];
    }
}

?>