<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class UserSendMail extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["subject" => "required", "content" => "required"];
    }
    public function messages()
    {
        return ["subject.required" => "Chủ đề không được để trống", "content.required" => "Nội dung gửi không thể trống"];
    }
}

?>