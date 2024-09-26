<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class SingBox
{
    public $flag = "sing-box";
    private $servers;
    private $user;
    public function __construct($user, $servers, array $options = NULL)
    {
        $this->user = $user;
        $this->servers = $servers;
    }
    public function handle()
    {
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = $this->user["username"] ?? config("aikopanel.app_name", "AikoPanel");
        $config = $this->loadConfig();
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_ = $this->buildOutbounds($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_);
        $config["outbounds"] = $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_;
        $user = $this->user;
        return response($config, 200)->header("subscription-userinfo", "upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"])->header("profile-update-interval", "24")->header("content-disposition", "attachment;filename*=UTF-8''" . rawurlencode($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_));
    }
    protected function loadConfig()
    {
        $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = new \App\Protocols\AikoPanel\Config\SingBoxConfig($this->user);
        $config = $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_->handle();
        return $config;
    }
    protected function buildOutbounds($appName)
    {
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_ = [];
        $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_ = ["tag" => $appName, "type" => "selector", "default" => "AikoPanel", "outbounds" => ["AikoPanel"]];
        $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_ = ["tag" => "AikoPanel", "type" => "urltest", "outbounds" => []];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] =& $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_;
        foreach ($this->servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                $_obfuscated_0D0A1A215C2D2C3B04140E16291801150F331F0C0D2B22_ = $this->buildShadowsocks($this->user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
                $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D0A1A215C2D2C3B04140E16291801150F331F0C0D2B22_;
                $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
                $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D360B3C2926261E5B142529103E5B3435033D40033622_ = $this->buildTrojan($this->user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
                $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D360B3C2926261E5B142529103E5B3435033D40033622_;
                $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
                $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D260A05165C0A2B2318142D2B03322C33211D0B3F0B32_ = $this->buildVmess($this->user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
                $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D260A05165C0A2B2318142D2B03322C33211D0B3F0B32_;
                $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
                $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                $_obfuscated_0D042C095B3E0F251621221E36170E04033E3336313832_ = $this->buildVless($this->user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
                $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D042C095B3E0F251621221E36170E04033E3336313832_;
                $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
                $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "hysteria") {
                $_obfuscated_0D1C3713010E19270B281E161F15360B400B231D343811_ = $this->buildHysteria($this->user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $this->user);
                $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D1C3713010E19270B281E161F15360B400B231D343811_;
                $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
                $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"];
            }
        }
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "direct", "type" => "direct"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "block", "type" => "block"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "dns-out", "type" => "dns"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_;
        return $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_;
    }
    protected function buildShadowsocks($password, $server)
    {
        if($server["cipher"] === "2022-blake3-aes-128-gcm") {
            $_obfuscated_0D1A0A14291A350239403916121A1F312A103024292711_ = \App\Utils\Helper::getServerKey($server["created_at"], 16);
            $_obfuscated_0D08403E0B0C3312230A0738371D08143B262136332C32_ = \App\Utils\Helper::uuidToBase64($password, 16);
            $password = $_obfuscated_0D1A0A14291A350239403916121A1F312A103024292711_ . ":" . $_obfuscated_0D08403E0B0C3312230A0738371D08143B262136332C32_;
        }
        if($server["cipher"] === "2022-blake3-aes-256-gcm") {
            $_obfuscated_0D1A0A14291A350239403916121A1F312A103024292711_ = \App\Utils\Helper::getServerKey($server["created_at"], 32);
            $_obfuscated_0D08403E0B0C3312230A0738371D08143B262136332C32_ = \App\Utils\Helper::uuidToBase64($password, 32);
            $password = $_obfuscated_0D1A0A14291A350239403916121A1F312A103024292711_ . ":" . $_obfuscated_0D08403E0B0C3312230A0738371D08143B262136332C32_;
        }
        $array = [];
        $array["tag"] = $server["name"];
        $array["type"] = "shadowsocks";
        $array["server"] = $server["host"];
        $array["server_port"] = $server["port"];
        $array["method"] = $server["cipher"];
        $array["password"] = $password;
        return $array;
    }
    protected function buildVmess($uuid, $server)
    {
        $array = [];
        $array["tag"] = $server["name"];
        $array["type"] = "vmess";
        $array["server"] = $server["host"];
        $array["server_port"] = $server["port"];
        $array["uuid"] = $uuid;
        $array["security"] = "auto";
        $array["alter_id"] = 0;
        $array["transport"] = [];
        if($server["tls"]) {
            $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_ = [];
            $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["enabled"] = true;
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"] ?? [];
                $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["insecure"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? true : false;
                $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["server_name"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"] ?? NULL;
            }
            $array["tls"] = $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_;
        }
        if($server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $array["transport"]["type"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                $_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
                $array["transport"]["path"] = $_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_[array_rand($_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_)];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"];
                $array["transport"]["host"] = $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_;
            }
        }
        if($server["network"] === "ws") {
            $array["transport"]["type"] = "ws";
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["transport"]["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["transport"]["headers"] = ["Host" => [$_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]]];
                }
                $array["transport"]["max_early_data"] = 2048;
                $array["transport"]["early_data_header_name"] = "Sec-WebSocket-Protocol";
            }
        }
        if($server["network"] === "grpc") {
            $array["transport"]["type"] = "grpc";
            if($server["networkSettings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["transport"]["service_name"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        return $array;
    }
    protected function buildVless($password, $server)
    {
        $array = ["type" => "vless", "tag" => $server["name"], "server" => $server["host"], "server_port" => $server["port"], "uuid" => $password, "packet_encoding" => "xudp"];
        $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"] ?? [];
        if($server["tls"]) {
            $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_ = [];
            $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["enabled"] = true;
            $array["flow"] = !empty($server["flow"]) ? $server["flow"] : "";
            $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"] ?? [];
            if($server["tls_settings"]) {
                $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["insecure"] = isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allow_insecure"]) && $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allow_insecure"] == 1 ? true : false;
                $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["server_name"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"] ?? NULL;
                if($server["tls"] == 2) {
                    $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["reality"] = ["enabled" => true, "public_key" => $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["public_key"], "short_id" => $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["short_id"]];
                }
                $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_ = ["chrome", "firefox", "safari", "ios", "edge", "qq"];
                $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_["utls"] = ["enabled" => true, "fingerprint" => $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_[array_rand($_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_)]];
            }
            $array["tls"] = $_obfuscated_0D1B0238263C3605163B071D112C3F13110823243B0622_;
        }
        if($server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["network_settings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $array["transport"]["type"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"])) {
                $array["transport"]["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
            }
        }
        if($server["network"] === "ws") {
            $array["transport"]["type"] = "ws";
            if($server["network_settings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["transport"]["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["transport"]["headers"] = ["Host" => [$_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]]];
                }
                $array["transport"]["max_early_data"] = 2048;
                $array["transport"]["early_data_header_name"] = "Sec-WebSocket-Protocol";
            }
        }
        if($server["network"] === "grpc") {
            $array["transport"]["type"] = "grpc";
            if($server["network_settings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["transport"]["service_name"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        if($server["network"] === "h2") {
            $array["transport"]["type"] = "http";
            if($server["network_settings"]) {
                $_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_ = $server["network_settings"];
                if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"])) {
                    $array["transport"]["host"] = [$_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"]];
                }
                if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"])) {
                    $array["transport"]["path"] = $_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"];
                }
            }
        }
        return $array;
    }
    protected function buildTrojan($password, $server)
    {
        $array = [];
        $array["tag"] = $server["name"];
        $array["type"] = "trojan";
        $array["server"] = $server["host"];
        $array["server_port"] = $server["port"];
        $array["password"] = $password;
        $array["tls"] = ["enabled" => true, "insecure" => $server["allow_insecure"] ? true : false, "server_name" => $server["server_name"]];
        if(isset($server["network"]) && in_array($server["network"], ["grpc", "ws"])) {
            $array["transport"]["type"] = $server["network"];
            if($server["network"] === "grpc" && isset($server["network_settings"]["serviceName"])) {
                $array["transport"]["service_name"] = $server["network_settings"]["serviceName"];
            }
            if($server["network"] === "ws") {
                if(isset($server["network_settings"]["path"])) {
                    $array["transport"]["path"] = $server["network_settings"]["path"];
                }
                if(isset($server["network_settings"]["headers"]["Host"])) {
                    $array["transport"]["headers"] = ["Host" => [$server["network_settings"]["headers"]["Host"]]];
                }
                $array["transport"]["max_early_data"] = 2048;
                $array["transport"]["early_data_header_name"] = "Sec-WebSocket-Protocol";
            }
        }
        return $array;
    }
    protected function buildHysteria($password, $server, $user)
    {
        $array = ["server" => $server["host"], "server_port" => $server["port"], "tls" => ["enabled" => true, "insecure" => $server["insecure"] ? true : false, "server_name" => $server["server_name"]]];
        if(is_null($server["version"]) || $server["version"] == 1) {
            $array["auth_str"] = $password;
            $array["tag"] = $server["name"];
            $array["type"] = "hysteria";
            $array["up_mbps"] = $user->speed_limit ? min($server["down_mbps"], $user->speed_limit) : $server["down_mbps"];
            $array["down_mbps"] = $user->speed_limit ? min($server["up_mbps"], $user->speed_limit) : $server["up_mbps"];
            if($server["is_obfs"]) {
                $array["obfs"] = $server["server_key"];
            }
            $array["disable_mtu_discovery"] = true;
        } elseif($server["version"] == 2) {
            $array["password"] = $password;
            $array["tag"] = $server["name"];
            $array["type"] = "hysteria2";
            $array["password"] = $password;
            if($server["is_obfs"]) {
                $array["obfs"]["type"] = "salamander";
                $array["obfs"]["password"] = $server["server_key"];
            }
        }
        return $array;
    }
}

?>