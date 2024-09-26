<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class UserUpdate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["remind_expire" => "in:0,1", "remind_traffic" => "in:0,1"];
    }
    public function messages()
    {
        return ["show.in" => __("Incorrect format of expiration reminder"), "renew.in" => __("Incorrect traffic alert format")];
    }
}

?>