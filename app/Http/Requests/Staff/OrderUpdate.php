<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Staff;

class OrderUpdate extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["status" => "in:0,1,2,3", "commission_status" => "in:0,1,3"];
    }
    public function messages()
    {
        return ["status.in" => "Định dạng trạng thái bán hàng không đúng", "commission_status.in" => "Định dạng trạng thái hoa hồng không đúng"];
    }
}

?>