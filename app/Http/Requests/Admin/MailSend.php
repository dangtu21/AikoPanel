<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class MailSend extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["type" => "required|in:1,2,3,4", "subject" => "required", "content" => "required", "receiver" => "array"];
    }
    public function messages()
    {
        return ["type.required" => "Loại gửi không được để trống", "type.in" => "Loại gửi không hợp lệ", "subject.required" => "Tiêu đề không được để trống", "content.required" => "Nội dung không được để trống", "receiver.array" => "Người nhận phải là một mảng"];
    }
}

?>