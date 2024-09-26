<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Staff;

class OrderAssign extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["plan_id" => "required", "email" => "required", "total_amount" => "required", "period" => "required|in:one_day_price,month_price,week_price,two_month_price,quarter_price,half_year_price,year_price,two_year_price,three_year_price,onetime_price,reset_price"];
    }
    public function messages()
    {
        return ["plan_id.required" => "Đăng ký không được để trống", "email.required" => "Email không được để trống", "total_amount.required" => "Số tiền thanh toán không được để trống", "period.required" => "Chu kỳ đăng ký không được để trống", "period.in" => "Chu kỳ đăng ký không hợp lệ"];
    }
}

?>