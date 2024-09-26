<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Staff;

class UserFetch extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["filter.*.key" => "required|in:id,email,transfer_enable,device_limit,appleid_limit,d,expired_at,uuid,token,invite_by_email,invite_user_id,plan_id,banned,register_ip", "filter.*.condition" => "required|in:>,<,=,>=,<=,~,!=", "filter.*.value" => "required"];
    }
    public function messages()
    {
        return ["filter.*.key.required" => "Khóa lọc không được để trống", "filter.*.key.in" => "Tham số khóa lọc không hợp lệ", "filter.*.condition.required" => "Điều kiện lọc không được để trống", "filter.*.condition.in" => "Tham số điều kiện lọc không hợp lệ", "filter.*.value.required" => "Giá trị lọc không được để trống"];
    }
}

?>