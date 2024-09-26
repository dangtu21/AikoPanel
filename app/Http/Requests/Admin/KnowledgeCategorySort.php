<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class KnowledgeCategorySort extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["knowledge_category_ids" => "required|array"];
    }
    public function messages()
    {
        return ["knowledge_category_ids.required" => "Hãy chọn ít nhất một danh mục", "knowledge_category_ids.array" => "Danh mục phải là một mảng"];
    }
}

?>