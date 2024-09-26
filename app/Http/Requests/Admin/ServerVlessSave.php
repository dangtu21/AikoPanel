<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class ServerVlessSave extends \Illuminate\Foundation\Http\FormRequest
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
        return ["show" => "", "name" => "required", "group_id" => "required|array", "ips" => "nullable|array", "route_id" => "nullable|array", "parent_id" => "nullable|integer", "host" => "required|conditional_not_ip:ip,record_id", "ip" => "nullable|ipv4|required_without:host", "port" => "required", "server_port" => "required", "tls" => "required|in:0,1,2", "tags" => "nullable|array", "rate" => "required|numeric", "network" => "required", "network_settings" => "nullable|array", "tls_settings" => "nullable|array", "flow" => "nullable|in:xtls-rprx-vision", "arrange_priority" => "nullable|in:0,1", "speed_limit" => "nullable|numeric"];
    }
    public function messages()
    {
        return ["name.required" => "Tên không được để trống", "group_id.required" => "Nhóm không được để trống", "group_id.array" => "Nhóm không đúng định dạng", "route_id.array" => "Định dạng tuyến đường không đúng", "parent_id.integer" => "Định dạng ID cha không đúng", "host.required_without" => "Host là bắt buộc nếu không có IP", "host.conditional_not_ip" => "Host không được chứa địa chỉ IP khi IPv4 được chọn", "ip.ipv4" => "Định dạng IP không đúng", "ip.required_without" => "IP là bắt buộc nếu không có host", "port.required" => "Cổng không được để trống", "server_port.required" => "Cổng máy chủ không được để trống", "tls.required" => "TLS không được để trống", "rate.required" => "Tỷ lệ không được để trống", "rate.numeric" => "Tỷ lệ phải là số", "network.required" => "Mạng không được để trống", "network.in" => "Mạng không đúng định dạng", "arrange_priority.in" => "Định dạng ưu tiên sắp xếp không đúng", "speed_limit.numeric" => "Định dạng giới hạn tốc độ không đúng"];
    }
}

?>