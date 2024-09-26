<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Client;

class ClientController extends \App\Http\Controllers\Controller
{
    public function subscribe(\Illuminate\Http\Request $request)
    {
        if(!\App\Utils\Helper::checklicense()) {
            return view("license");
        }
        $flag = $request->input("flag") ?? $_SERVER["HTTP_USER_AGENT"] ?? "";
        $flag = strtolower($flag);
        $_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_ = $request->input("sni");
        $user = $request->user;
        $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
        if($_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user)) {
            $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_ = new \App\Services\ServerService();
            $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_->getAvailableServers($user);
            if((int) config("aikopanel.arrange_server_enable", 0)) {
                usort($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, function ($a, $b) {
                    $arrangePriorityA = isset($a["arrange_priority"]) ? $a["arrange_priority"] : PHP_INT_MAX;
                    $arrangePriorityB = isset($b["arrange_priority"]) ? $b["arrange_priority"] : PHP_INT_MAX;
                    $isPort443A = isset($a["server_port"]) && $a["server_port"] == 443;
                    $isPort443B = isset($b["server_port"]) && $b["server_port"] == 443;
                    if($arrangePriorityA == 1 && $arrangePriorityB != 1) {
                        return -1;
                    }
                    if($arrangePriorityA != 1 && $arrangePriorityB == 1) {
                        return 1;
                    }
                    if($arrangePriorityA != $arrangePriorityB) {
                    } else {
                        if($isPort443A != $isPort443B) {
                            return $isPort443B - $isPort443A;
                        }
                        $a["online"];
                        $b["online"];
                    }
                });
            }
            $_obfuscated_0D312F5B39065B130A1E3B402B2B311C32043E04280F01_ = 1;
            foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as &$_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                if(empty($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["online"])) {
                    $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["online"] = 0;
                }
                $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"] = "[" . $_obfuscated_0D312F5B39065B130A1E3B402B2B311C32043E04280F01_ . "]› " . $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["name"];
                $_obfuscated_0D312F5B39065B130A1E3B402B2B311C32043E04280F01_++;
            }
            $_obfuscated_0D153E0936330E262A07150F23340A3815120E5C0D2532_ = \App\Models\Sni::all();
            $_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ = $_obfuscated_0D153E0936330E262A07150F23340A3815120E5C0D2532_->map(function ($item) {
                return ["value" => $item->value, "label" => $item->label, "abbreviation" => $item->abbreviation, "content" => $item->content];
            })->toArray();
            if($_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_) {
                foreach ($_obfuscated_0D07293F06031013301E262A1440333E0D2D3C29223111_ as $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_) {
                    if($_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_["abbreviation"] === $_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_) {
                        $_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_ = $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_["value"];
                    }
                }
            }
            $_obfuscated_0D0B030733281A2B261207271032391D3F011A5B102D11_ = new Protocols\ServerInfoHandler();
            $_obfuscated_0D0B030733281A2B261207271032391D3F011A5B102D11_->setSubscribeInfoToServers($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, $user, $request->input("sni"));
            if($flag) {
                if($flag === "appleid") {
                    $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = new Protocols\IDAPPLE($user);
                    exit($_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->handle());
                }
                foreach (array_reverse(glob(app_path("Protocols//AikoPanel") . "/*.php")) as $file) {
                    $file = "App\\Protocols\\AikoPanel\\" . basename($file, ".php");
                    $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = new $file($user, $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, $_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_);
                    if(strpos($flag, $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->flag) !== false) {
                        exit($_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->handle());
                    }
                }
            }
            $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = new \App\Protocols\AikoPanel\AikoPanel($user, $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_, $_obfuscated_0D38080330183B40165C1B0D0E132C2D5B182F2F5C1B32_);
            return $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->handle();
        } else {
            $_obfuscated_0D2B23113B2C2C071C08051D28300C193C111806371532_ = \App\Utils\Helper::getOverdueMessage();
            if(empty($_obfuscated_0D2B23113B2C2C071C08051D28300C193C111806371532_)) {
                return response(["ret" => 0, "msg" => "Tài khoản của bạn đã hết hạn, vui lòng gia hạn để sử dụng dịch vụ."]);
            }
            $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = new Protocols\Overdue($user);
            if($flag === "sing-box") {
                exit($_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->singbox());
            }
            exit($_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->normal());
        }
    }
}

?>