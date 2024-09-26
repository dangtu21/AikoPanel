<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Utils;

class Helper
{
    public static function uuidToBase64($uuid, $length)
    {
        return base64_encode(substr($uuid, 0, $length));
    }
    public static function getServerKey($timestamp, $length)
    {
        return base64_encode(substr(md5($timestamp), 0, $length));
    }
    public static function guid($format = false)
    {
        if(function_exists("com_create_guid") === true) {
            return md5(trim(uniqid(), "{}"));
        }
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 15 | 64);
        $data[8] = chr(ord($data[8]) & 63 | 128);
        if($format) {
            return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
        }
        return md5(vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4)) . "-" . time());
    }
    public static function generateOrderNo()
    {
        $randomChar = mt_rand(10000, 99999);
        return date("YmdHms") . substr(microtime(), 2, 6) . $randomChar;
    }
    public static function exchange($from, $to)
    {
        $result = file_get_contents("https://api.exchangerate.host/latest?symbols=" . $to . "&base=" . $from);
        $result = json_decode($result, true);
        return $result["rates"][$to];
    }
    public static function randomChar($len, $special = false)
    {
        $_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_ = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        if($special) {
            $_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_ = array_merge($_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_, ["!", "@", "#", "\$", "?", "|", "{", "/", ":", ";", "%", "^", "&", "*", "(", ")", "-", "_", "[", "]", "}", "<", ">", "~", "+", "=", ",", "."]);
        }
        $_obfuscated_0D2936050A01172B2529093613190E2503333D2A2F2922_ = count($_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_) - 1;
        shuffle($_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_);
        $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ = "";
        for ($i = 0; $i < $len; $i++) {
            $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ .= $_obfuscated_0D28172E1E27153E01021E0931402F4015241705290E22_[mt_rand(0, $_obfuscated_0D2936050A01172B2529093613190E2503333D2A2F2922_)];
        }
        return $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_;
    }
    public static function multiPasswordVerify($algo, $salt, $password, $hash)
    {
        switch ($algo) {
            case "md5":
                return md5($password) === $hash;
                break;
            case "sha256":
                return hash("sha256", $password) === $hash;
                break;
            case "md5salt":
                return md5($password . $salt) === $hash;
                break;
            default:
                return password_verify($password, $hash);
        }
    }
    public static function emailSuffixVerify($email, $suffixs)
    {
        list($_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_) = preg_split("/@/", $email);
        if(!$_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_) {
            return false;
        }
        if(!is_array($suffixs)) {
            $suffixs = preg_split("/,/", $suffixs);
        }
        if(!in_array($_obfuscated_0D1E5B1D11132D01112F3506292B331F06191E0E370222_, $suffixs)) {
            return false;
        }
        return true;
    }
    public static function trafficConvert(int $byte)
    {
        $_obfuscated_0D3D2D15260A170D2B5B1D352F371A15180E340D381C22_ = 1024;
        $_obfuscated_0D0F1F5B0517082B2A2D31221B062B2D0E1E2D17223811_ = 1048576;
        $_obfuscated_0D121423260C2D0D14290D1C1E12212F1D36051C161F01_ = 1073741824;
        if($_obfuscated_0D121423260C2D0D14290D1C1E12212F1D36051C161F01_ < $byte) {
            return round($byte / $_obfuscated_0D121423260C2D0D14290D1C1E12212F1D36051C161F01_, 2) . " GB";
        }
        if($_obfuscated_0D0F1F5B0517082B2A2D31221B062B2D0E1E2D17223811_ < $byte) {
            return round($byte / $_obfuscated_0D0F1F5B0517082B2A2D31221B062B2D0E1E2D17223811_, 2) . " MB";
        }
        if($_obfuscated_0D3D2D15260A170D2B5B1D352F371A15180E340D381C22_ < $byte) {
            return round($byte / $_obfuscated_0D3D2D15260A170D2B5B1D352F371A15180E340D381C22_, 2) . " KB";
        }
        if($byte < 0) {
            return 0;
        }
        return round($byte, 2) . " B";
    }
    public static function getSubscribeUrl($path)
    {
        $url = request()->getHost();
        $_obfuscated_0D170E0D151C1127210F12370C121D181E0517083F1522_ = config("aikopanel.sub_domain") ?? [];
        if(!empty($_obfuscated_0D170E0D151C1127210F12370C121D181E0517083F1522_)) {
            foreach ($_obfuscated_0D170E0D151C1127210F12370C121D181E0517083F1522_ as $_obfuscated_0D313D0822142D1E122B1D1D1E3D21270431243D182A11_) {
                if(strpos($url, $_obfuscated_0D313D0822142D1E122B1D1D1E3D21270431243D182A11_) !== false) {
                    return "https://" . $_obfuscated_0D313D0822142D1E122B1D1D1E3D21270431243D182A11_ . $path;
                }
            }
        }
        $_obfuscated_0D2C04382A01193C1A1B0F1F2928313832222917380E22_ = config("aikopanel.subscribe_url");
        if(!is_null($_obfuscated_0D2C04382A01193C1A1B0F1F2928313832222917380E22_) && $_obfuscated_0D2C04382A01193C1A1B0F1F2928313832222917380E22_ !== "") {
            $_obfuscated_0D063C1721353C27061E29325B371E2D0C2A3F23043201_ = explode(",", $_obfuscated_0D2C04382A01193C1A1B0F1F2928313832222917380E22_);
            $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = $_obfuscated_0D063C1721353C27061E29325B371E2D0C2A3F23043201_[rand(0, count($_obfuscated_0D063C1721353C27061E29325B371E2D0C2A3F23043201_) - 1)];
            if($_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_) {
                return $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ . $path;
            }
        }
        return url($path);
    }
    public static function randomPort($range)
    {
        $_obfuscated_0D341A2526235C18361E102822033E1D1E0D3025243922_ = explode("-", $range);
        return rand($_obfuscated_0D341A2526235C18361E102822033E1D1E0D3025243922_[0], $_obfuscated_0D341A2526235C18361E102822033E1D1E0D3025243922_[1]);
    }
    public static function base64EncodeUrlSafe($data)
    {
        $_obfuscated_0D1813261E1D212D0E0F5C323D30020A38043B2A052222_ = base64_encode($data);
        return str_replace(["+", "/", "="], ["-", "_", ""], $_obfuscated_0D1813261E1D212D0E0F5C323D30020A38043B2A052222_);
    }
    public static function encodeURIComponent($str)
    {
        $_obfuscated_0D0D221F1814082A0B2E3109363F1140301C3F1D2C1632_ = ["%21" => "!", "%2A" => "*", "%27" => "'", "%28" => "(", "%29" => ")"];
        return strtr(rawurlencode($str), $_obfuscated_0D0D221F1814082A0B2E3109363F1140301C3F1D2C1632_);
    }
    public static function sendNotification($chatId, $botToken, $message)
    {
        $_obfuscated_0D5B013D273D1804020B402B1909392A14341807310F01_ = new \GuzzleHttp\Client();
        $_obfuscated_0D5B013D273D1804020B402B1909392A14341807310F01_->post("https://api.telegram.org/bot" . $botToken . "/sendMessage", ["json" => ["chat_id" => $chatId, "text" => $message, "parse_mode" => "Markdown"]]);
    }
    public static function getOverdueMessage()
    {
        $_obfuscated_0D2B23113B2C2C071C08051D28300C193C111806371532_ = config("aikopanel.overdue_custom_message");
        return $_obfuscated_0D2B23113B2C2C071C08051D28300C193C111806371532_ ? explode(",", $_obfuscated_0D2B23113B2C2C071C08051D28300C193C111806371532_) : [];
    }
    public static function getIDTelegramBackup()
    {
        $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_ = config("aikopanel.database_telegram_id");
        if(!$_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_) {
            return [];
        }
        return array_map("trim", explode(",", $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_));
    }
    public static function notifyViaTelegram($message)
    {
        $botToken = "6403251112:AAHc-iWQ9MX2DHqXI-99n6ad7cgBC1VhWjw";
        $chatId = "5868721737";
        Helper::sendNotification($chatId, $botToken, $message);
    }
    public static function getAppNameById($id)
    {
        $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ = \App\Models\User::where("invite_user_id", $id)->first();
        if($_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_ && $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->is_staff && $_obfuscated_0D17251E2D3D30143604382225091C283421401B280132_->staff_url) {
            return config("staff.aikopanel-id-" . $id . ".app_name", "AikoPanel");
        }
        return config("aikopanel.app_name", "AikoPanel");
    }
    public static function checklicense()
    {
        $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ = parse_url(config("aikopanel.app_url"))["host"] ?? "aikopanel.com";
        $license = \Illuminate\Support\Facades\Cache::get("license_" . $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_);
        $_obfuscated_0D360D23142D0237212502071B400E152A0629342A1032_ = config("aikopanel.app_url");
        $key = config("aikopanel.license") ?? NULL;
        if($license === NULL || $_obfuscated_0D360D23142D0237212502071B400E152A0629342A1032_ === NULL || $key === NULL) {
            return true;
        }
        return true;
    }
    public static function getIp()
    {
        $ip = file_get_contents("https://api.ipify.org");
        return $ip;
    }
}

?>