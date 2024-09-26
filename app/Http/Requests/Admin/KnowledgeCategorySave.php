<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class KnowledgeCategorySave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["name" => "required", "language" => "required"];
    }
    public function messages()
    {
        return ["name.required" => "Tên không được để trống", "language.required" => "Ngôn ngữ không được để trống"];
    }
}

?>