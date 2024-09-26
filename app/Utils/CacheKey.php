<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Utils;

class CacheKey
{
    const KEYS = ["EMAIL_VERIFY_CODE" => "Mã xác minh e-mail", "LAST_SEND_EMAIL_VERIFY_TIMESTAMP" => "Thời gian gửi mã xác minh e-mail cuối cùng", "SERVER_VMESS_ONLINE_USER" => "Người dùng trực tuyến của nút vmess", "SERVER_VMESS_ONLINE_IP" => "online ip", "SERVER_VMESS_LAST_CHECK_AT" => "Thời gian kiểm tra nút vmess cuối cùng", "SERVER_VMESS_LAST_PUSH_AT" => "Thời gian đẩy nút vmess cuối cùng", "SERVER_TROJAN_ONLINE_USER" => "Người dùng trực tuyến của nút trojan", "SERVER_TROJAN_ONLINE_IP" => "online ip", "SERVER_TROJAN_LAST_CHECK_AT" => "Thời gian kiểm tra nút trojan cuối cùng", "SERVER_TROJAN_LAST_PUSH_AT" => "Thời gian đẩy nút trojan cuối cùng", "SERVER_SHADOWSOCKS_ONLINE_USER" => "Người dùng trực tuyến của nút ss", "SERVER_SHADOWSOCKS_ONLINE_IP" => "online ip", "SERVER_SHADOWSOCKS_LAST_CHECK_AT" => "Thời gian kiểm tra nút ss cuối cùng", "SERVER_SHADOWSOCKS_LAST_PUSH_AT" => "Thời gian đẩy nút ss cuối cùng", "SERVER_HYSTERIA_ONLINE_USER" => "Người dùng trực tuyến của nút hysteria", "SERVER_HYSTERIA_ONLINE_IP" => "online ip", "SERVER_HYSTERIA_LAST_CHECK_AT" => "Thời gian kiểm tra nút hysteria cuối cùng", "SERVER_HYSTERIA_LAST_PUSH_AT" => "Thời gian đẩy nút hysteria cuối cùng", "SERVER_VLESS_ONLINE_USER" => "Người dùng trực tuyến của nút vless", "SERVER_VLESS_ONLINE_IP" => "online ip", "SERVER_VLESS_LAST_CHECK_AT" => "Thời gian kiểm tra nút vless cuối cùng", "SERVER_VLESS_LAST_PUSH_AT" => "Thời gian đẩy nút vless cuối cùng", "TEMP_TOKEN" => "Mã thông báo tạm thời", "LAST_SEND_EMAIL_REMIND_TRAFFIC" => "Thời gian gửi lưu lượng nhắc nhở e-mail cuối cùng", "LAST_SEND_TELE_REMIND_TRAFFIC" => "Thời gian gửi lưu lượng nhắc nhở telegram cuối cùng", "SCHEDULE_LAST_CHECK_AT" => "Thời gian kiểm tra lịch trình cuối cùng", "REGISTER_IP_RATE_LIMIT" => "Giới hạn tốc độ đăng ký IP", "LAST_SEND_LOGIN_WITH_MAIL_LINK_TIMESTAMP" => "Thời gian gửi liên kết đăng nhập với e-mail cuối cùng", "PASSWORD_ERROR_LIMIT" => "Giới hạn lỗi mật khẩu", "USER_SESSIONS" => "Phiên người dùng", "FORGET_REQUEST_LIMIT" => "Giới hạn yêu cầu quên mật khẩu", "STAFF_GENERATE_USER_LIMIT" => "Giới hạn nhân viên tạo người dùng"];
    public static function get($key, $uniqueValue)
    {
        if(!in_array($key, array_keys(self::KEYS))) {
            abort(500, "key is not in cache key list");
        }
        return $key . "_" . $uniqueValue;
    }
}

?>