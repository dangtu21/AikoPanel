<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class SniSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["label" => "required", "value" => "required", "abbreviation" => "required", "content" => "nullable"];
    }
    public function messages()
    {
        return ["label.required" => "Tên sni không được bỏ trống", "value.required" => "sni không được bỏ trống", "abbreviation.required" => "Tên viết tắt không được bỏ trống"];
    }
}

?>