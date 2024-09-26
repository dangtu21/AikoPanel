<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class NoticeSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["title" => "required", "content" => "required", "img_url" => "nullable|url", "tags" => "nullable|array", "staff_urls" => "nullable"];
    }
    public function messages()
    {
        return ["title.required" => "Tiêu đề không được để trống", "content.required" => "Nội dung không được để trống", "img_url.url" => "Định dạng ảnh không hợp lệ", "tags.array" => "Thẻ phải là một mảng", "staff_urls.array" => "Thẻ phải là một mảng"];
    }
}

?>