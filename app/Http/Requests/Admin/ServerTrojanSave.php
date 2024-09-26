<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class ServerTrojanSave extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        \Illuminate\Support\Facades\Validator::extend("conditional_not_ip", function ($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            list($ipField, $recordIdField) = $parameters;
            if(!empty($data[$ipField]) && !empty($data[$recordIdField])) {
                return !filter_var($value, FILTER_VALIDATE_IP);
            }
            return true;
        });
        return ["show" => "", "name" => "required", "group_id" => "required|array", "ips" => "nullable|array", "route_id" => "nullable|array", "parent_id" => "nullable|integer", "host" => "required|conditional_not_ip:ip,record_id", "ip" => "nullable|ipv4|required_without:host", "port" => "required", "server_port" => "required", "network" => "required", "network_settings" => "nullable|array", "allow_insecure" => "nullable|in:0,1", "server_name" => "nullable", "tags" => "nullable|array", "rate" => "required|numeric", "arrange_priority" => "nullable|in:0,1", "speed_limit" => "nullable|numeric"];
    }
    public function messages()
    {
        return ["name.required" => "Tên không được để trống", "group_id.required" => "Nhóm không được để trống", "group_id.array" => "Nhóm không đúng định dạng", "route_id.array" => "Định dạng tuyến đường không đúng", "parent_id.integer" => "Định dạng cha không đúng", "host.required" => "Host không được để trống", "host.conditional_not_ip" => "Host không đúng định dạng", "ip.ipv4" => "Định dạng IP không đúng", "ip.required_without" => "IP không được để trống", "port.required" => "Port không được để trống", "server_port.required" => "Server Port không được để trống", "network.required" => "Network không được để trống", "allow_insecure.in" => "Định dạng insecure không đúng", "rate.required" => "Rate không được để trống", "rate.numeric" => "Định dạng rate không đúng", "arrange_priority.in" => "Định dạng arrange_priority không đúng", "speed_limit.numeric" => "Định dạng speed_limit không đúng"];
    }
}

?>