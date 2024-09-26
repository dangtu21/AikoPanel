<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class CouponGenerate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["generate_count" => "nullable|integer|max:500", "name" => "required", "type" => "required|in:1,2", "value" => "required|integer", "started_at" => "required|integer", "ended_at" => "required|integer", "limit_use" => "nullable|integer", "limit_use_with_user" => "nullable|integer", "limit_plan_ids" => "nullable|array", "limit_period" => "nullable|array", "limit_staff_urls" => "nullable|array", "code" => ""];
    }
    public function messages()
    {
        return ["generate_count.integer" => "Nhập số lượng phải là một số", "generate_count.max" => "Số lượng tối đa là 500", "name.required" => "Tên không được để trống", "type.required" => "Loại không được để trống", "type.in" => "Loại không hợp lệ", "value.required" => "Số tiền hoặc tỷ lệ không được để trống", "value.integer" => "Số tiền hoặc tỷ lệ phải là một số", "started_at.required" => "Yêu cầu nhập thời gian bắt đầu", "started_at.integer" => "Định dạng thời gian bắt đầu không hợp lệ", "ended_at.required" => "Yêu cầu nhập thời gian kết thúc", "ended_at.integer" => "Định dạng thời gian kết thúc không hợp lệ", "limit_use.integer" => "Giới hạn sử dụng phải là một số", "limit_use_with_user.integer" => "Giới hạn sử dụng cho mỗi người dùng phải là một số", "limit_plan_ids.array" => "Giới hạn sử dụng cho gói phải là một mảng", "limit_period.array" => "Giới hạn sử dụng cho thời gian phải là một mảng", "limit_staff_urls.array" => "Link của nhân viên phải là một mảng"];
    }
}

?>