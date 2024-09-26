<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Requests\Staff;

class ConfigSave extends \Illuminate\Foundation\Http\FormRequest
{
    const RULES = ["app_name" => "", "app_description" => "", "logo" => "nullable|url", "background_url" => "nullable|url", "custom_html" => "nullable", "telegram_bot_enable" => "in:0,1", "telegram_bot_token" => "", "telegram_discuss_id" => "", "telegram_channel_id" => "", "telegram_discuss_link" => "nullable|url", "zalo_discuss_link" => "nullable|url", "report_user_traffic_today" => "in:0,1", "id_group_admin_report_traffic_user_today" => "", "interval_report_user_traffic_to_user_today" => "nullable|integer|min:1|max:60", "id_group_user_report_traffic_user_today" => "", "report_node_traffic_today" => "in:0,1", "id_group_admin_report_traffic_node_today" => "", "interval_report_node_traffic_to_user_today" => "nullable|integer|min:1|max:60", "id_group_user_report_traffic_node_today" => "", "report_node_online" => "in:0,1", "id_group_admin_report_node_online_today" => "", "interval_report_node_online_to_user_today" => "nullable|integer|min:1|max:60", "id_group_user_report_node_online_today" => ""];
    public function rules()
    {
        return self::RULES;
    }
    public function messages()
    {
        return ["app_url.url" => "Định dạng URL trang web không đúng, phải chứa http(s)://", "telegram_discuss_link.url" => "Địa chỉ nhóm Telegram phải là định dạng URL, phải chứa http(s)://", "zalo_discuss_link.url" => "Địa chỉ nhóm Zalo phải là định dạng URL, phải chứa http(s)://", "logo.url" => "Định dạng URL LOGO không đúng, phải chứa https(s)://", "background_url.url" => "Định dạng Url Background không đúng, phải chứa https(s)://", "appleid_api.url" => "Định dạng URL API AppleID không đúng, phải chứa http(s)://", "appleid_custom_url.url" => "Định dạng URL AppleID không đúng, phải chứa http(s)://", "report_node_online" => "Báo cáo trạng thái nút không hợp lệ", "report_user_traffic_today.in" => "Báo cáo lưu lượng người dùng không hợp lệ", "interval_report_user_traffic_to_user_today.integer" => "Thời gian báo cáo lưu lượng người dùng cho người dùng phải là số nguyên", "interval_report_user_traffic_to_user_today.min" => "Thời gian báo cáo lưu lượng người dùng cho người dùng phải lớn hơn 0", "interval_report_user_traffic_to_user_today.max" => "Thời gian báo cáo lưu lượng người dùng cho người dùng phải nhỏ hơn 60", "report_node_traffic_today.in" => "Báo cáo lưu lượng nút không hợp lệ", "interval_report_node_traffic_to_user_today.integer" => "Thời gian báo cáo lưu lượng nút cho người dùng phải là số nguyên", "interval_report_node_traffic_to_user_today.min" => "Thời gian báo cáo lưu lượng nút cho người dùng phải lớn hơn 0", "interval_report_node_traffic_to_user_today.max" => "Thời gian báo cáo lưu lượng nút cho người dùng phải nhỏ hơn 60", "interval_check_server.integer" => "Thời gian kiểm tra trạng thái của nút phải là số nguyên", "interval_check_server.min" => "Thời gian kiểm tra trạng thái của nút phải lớn hơn 0", "interval_check_server.max" => "Thời gian kiểm tra trạng thái của nút phải nhỏ hơn 60", "maintenance_mode_enable.in" => "Chế độ bảo trì không hợp lệ"];
    }
}

?>