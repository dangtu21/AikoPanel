<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class UserTransfer extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["transfer_amount" => "required|integer|min:1"];
    }
    public function messages()
    {
        return ["transfer_amount.required" => __("The transfer amount cannot be empty"), "transfer_amount.integer" => __("The transfer amount parameter is wrong"), "transfer_amount.min" => __("The transfer amount parameter is wrong")];
    }
}

?>