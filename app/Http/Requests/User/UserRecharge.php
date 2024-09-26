<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class UserRecharge extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        $_obfuscated_0D322A5C1440403B3D213C26020928263C260636392522_ = config("aikopanel.min_recharge_amount", 1000);
        $_obfuscated_0D3804140917131209142E3E18052718135B023F163111_ = config("aikopanel.max_recharge_amount", 100000);
        return ["recharge_amount" => ["required", "integer", "min:" . $_obfuscated_0D322A5C1440403B3D213C26020928263C260636392522_, "max:" . $_obfuscated_0D3804140917131209142E3E18052718135B023F163111_]];
    }
    public function messages()
    {
        return ["recharge_amount.required" => __("Số tiền nạp không được để trống"), "recharge_amount.integer" => __("Tham số số tiền nạp không đúng"), "recharge_amount.min" => __("Số tiền nạp phải lớn hơn hoặc bằng :min", ["min" => config("aikopanel.min_recharge_amount", 1000)]), "recharge_amount.max" => __("Số tiền nạp phải nhỏ hơn hoặc bằng :max", ["max" => config("aikopanel.max_recharge_amount", 100000)])];
    }
}

?>