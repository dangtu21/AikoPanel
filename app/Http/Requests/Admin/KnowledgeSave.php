<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class KnowledgeSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["category" => "required", "language" => "required", "title" => "required", "body" => "required", "staff_urls" => "nullable"];
    }
    public function messages()
    {
        return ["title.required" => "Tiêu đề không được để trống", "category.required" => "Danh mục không được để trống", "body.required" => "Nội dung không được để trống", "language.required" => "Ngôn ngữ không được để trống"];
    }
}

?>