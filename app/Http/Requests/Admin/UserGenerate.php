<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class UserGenerate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["generate_count" => "nullable|integer|max:500", "expired_at" => "nullable|integer", "plan_id" => "nullable|integer", "email_prefix" => "nullable", "email_suffix" => "required", "email_staff" => "nullable", "password" => "nullable"];
    }
    public function messages()
    {
        return ["generate_count.integer" => "Tạo số lượng phải là một số nguyên", "generate_count.max" => "Tạo số lượng tối đa là 500"];
    }
}

?>