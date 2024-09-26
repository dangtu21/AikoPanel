<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Passport;

class CommSendEmailVerify extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["email" => "required|email:strict"];
    }
    public function messages()
    {
        return ["email.required" => __("Email can not be empty"), "email.email" => __("Email format is incorrect")];
    }
}

?>