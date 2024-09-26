<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Staff;

class PlanSort extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["plan_ids" => "required|array"];
    }
    public function messages()
    {
        return ["plan_ids.required" => "ID kế hoạch đăng ký không được để trống", "plan_ids.array" => "ID kế hoạch đăng ký phải là một mảng"];
    }
}

?>