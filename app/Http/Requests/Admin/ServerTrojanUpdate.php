<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class ServerTrojanUpdate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["show" => "in:0,1", "report" => "in:0,1"];
    }
    public function messages()
    {
        return ["show.in" => "Định dạng hiển thị không đúng", "report.in" => "Định dạng báo cáo không đúng"];
    }
}

?>