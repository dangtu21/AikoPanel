<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\User;

class TicketSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return ["subject" => "required", "level" => "required|in:0,1,2", "message" => "required"];
    }
    public function messages()
    {
        return ["subject.required" => __("Ticket subject cannot be empty"), "level.required" => __("Ticket level cannot be empty"), "level.in" => __("Incorrect ticket level format"), "message.required" => __("Message cannot be empty")];
    }
}

?>