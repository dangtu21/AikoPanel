<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class OrderSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["plan_id" => "required", "period" => "required|in:one_day_price,month_price,week_price,two_month_price,quarter_price,half_year_price,year_price,two_year_price,three_year_price,onetime_price,reset_price"];
    }
    public function messages()
    {
        return ["plan_id.required" => __("Plan ID cannot be empty"), "period.required" => __("Plan period cannot be empty"), "period.in" => __("Wrong plan period")];
    }
}

?>