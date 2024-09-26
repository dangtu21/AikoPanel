<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class KnowledgeSort extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["knowledge_ids" => "required|array"];
    }
    public function messages()
    {
        return ["knowledge_ids.required" => "ID kiến thức không được để trống", "knowledge_ids.array" => "ID kiến thức phải là một mảng"];
    }
}

?>