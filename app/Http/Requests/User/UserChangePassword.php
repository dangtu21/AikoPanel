<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class UserChangePassword extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["old_password" => "required", "new_password" => "required|min:8"];
    }
    public function messages()
    {
        return ["old_password.required" => __("Old password cannot be empty"), "new_password.required" => __("New password cannot be empty"), "new_password.min" => __("Password must be greater than 8 digits")];
    }
}

?>