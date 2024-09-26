<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Admin;

class ServerHysteriaSave extends \Illuminate\Foundation\Http\FormRequest
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
        return ["show" => "", "name" => "required", "version" => "required|in:1,2", "group_id" => "required|array", "route_id" => "nullable|array", "parent_id" => "nullable|integer", "host" => "required|conditional_not_ip:ip,record_id", "ip" => "nullable|ipv4|required_without:host", "ips" => "nullable|array", "port" => "required", "server_port" => "required", "tags" => "nullable|array", "rate" => "required|numeric", "up_mbps" => "required|numeric|min:1", "down_mbps" => "required|numeric|min:1", "obfs" => "nullable", "obfs_password" => "nullable", "server_name" => "nullable", "insecure" => "required|in:0,1", "arrange_priority" => "nullable|in:0,1", "speed_limit" => "nullable|numeric"];
    }
    public function messages()
    {
        return ["name.required" => "Tên nút không thể trống", "version.required" => "Phiên bản không thể trống", "version.in" => "Định dạng phiên bản không chính xác", "group_id.required" => "Nhóm quyền không thể trống", "group_id.array" => "Định dạng nhóm quyền không chính xác", "route_id.array" => "Định dạng nhóm định tuyến không chính xác", "parent_id.integer" => "Định dạng nút cha không chính xác", "host.required_without" => "Host là bắt buộc nếu không có IP", "host.conditional_not_ip" => "Host không được chứa địa chỉ IP khi IPv4 được chọn", "ip.required_without" => "IP là bắt buộc nếu không có Host", "ip.ipv4" => "IP phải là một địa chỉ IPv4 hợp lệ", "port.required" => "Cổng kết nối không thể trống", "server_port.required" => "Cổng dịch vụ phía sau không thể trống", "tags.array" => "Định dạng thẻ không chính xác", "rate.required" => "Tỷ lệ không thể trống", "rate.numeric" => "Định dạng tỷ lệ không chính xác", "up_mbps.required" => "Tốc độ tải lên không thể trống", "up_mbps.numeric" => "Định dạng tốc độ tải lên không chính xác", "up_mbps.min" => "Tốc độ tải lên tối thiểu là 1", "down_mbps.required" => "Tốc độ tải xuống không thể trống", "down_mbps.numeric" => "Định dạng tốc độ tải xuống không chính xác", "down_mbps.min" => "Tốc độ tải xuống tối thiểu là 1", "insecure.required" => "Không an toàn không thể trống", "insecure.in" => "Định dạng không an toàn không chính xác", "speed_limit.numeric" => "Định dạng giới hạn tốc độ không chính xác"];
    }
}

?>