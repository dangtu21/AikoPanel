<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class TicketWithdraw extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["withdraw_method" => "required", "withdraw_account" => "required", "withdraw_name" => "required", "withdraw_amount" => "required"];
    }
    public function messages()
    {
        return ["withdraw_method.required" => __("The withdrawal method cannot be empty"), "withdraw_account.required" => __("The withdrawal account cannot be empty"), "withdraw_name.required" => __("The withdrawal name name cannot be empty"), "withdraw_amount.required" => __("The withdrawal amount cannot be empty")];
    }
}

?>