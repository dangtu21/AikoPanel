<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class OrderFetch extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["filter.*.key" => "required|in:email,id,trade_no,status,commission_status,user_id,invite_user_id,callback_no,commission_balance", "filter.*.condition" => "required|in:>,<,=,>=,<=,~,!=", "filter.*.value" => ""];
    }
    public function messages()
    {
        return ["filter.*.key.required" => "Khóa lọc không được để trống", "filter.*.key.in" => "Khóa lọc không hợp lệ", "filter.*.condition.required" => "Điều kiện lọc không được để trống", "filter.*.condition.in" => "Điều kiện lọc không hợp lệ"];
    }
}

?>