<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class ClashPC
{
    public $flag = "clashpc";
    private $custom_sni;
    private $servers;
    private $user;
    public function __construct($user, $servers, $custom_sni)
    {
        $this->user = $user;
        $this->servers = $servers;
        $this->custom_sni = $custom_sni;
    }
    public function handle()
    {
        $servers = $this->servers;
        $user = $this->user;
        $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_ = $this->custom_sni ?? $user["sni"] ?? NULL;
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = $user["username"] ?? \App\Utils\Helper::getAppNameById($user["id"]) ?? config("aikopanel.app_name", "AikoPanel");
        header("subscription-userinfo: upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"]);
        header("profile-update-interval: 24");
        header("content-disposition:attachment;filename*=UTF-8''" . rawurlencode($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_));
        header("profile-web-page-url:" . config("aikopanel.app_url"));
        $_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_ = base_path() . "/resources/rules/custom.clash.yaml";
        if(\File::exists($_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_)) {
            $config = \Symfony\Component\Yaml\Yaml::parseFile($_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_);
        } else {
            $config = Config\ClashConfig::getDefaultConfig();
        }
        $_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_ = [];
        $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ = [];
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks" && in_array($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["cipher"], ["aes-128-gcm", "aes-192-gcm", "aes-256-gcm", "chacha20-ietf-poly1305"])) {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
        }
        $config["proxies"] = array_merge($config["proxies"] ? $config["proxies"] : [], $_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_);
        foreach ($config["proxy-groups"] as $k => $_obfuscated_0D0619211E02095C050C240E1D12160F1C271137260D32_) {
            if(!is_array($config["proxy-groups"][$k]["proxies"])) {
                $config["proxy-groups"][$k]["proxies"] = [];
            }
            $_obfuscated_0D051937041E2737371906062237123E2E3F33232A3D11_ = false;
            foreach ($config["proxy-groups"][$k]["proxies"] as $_obfuscated_0D0F032F26080C37235C3F312C1540052208240F020322_) {
                foreach ($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ as $_obfuscated_0D08015C120F0223131F32060C39163B5B395B3B193822_) {
                    if(!$this->isRegex($_obfuscated_0D0F032F26080C37235C3F312C1540052208240F020322_)) {
                    } else {
                        $_obfuscated_0D051937041E2737371906062237123E2E3F33232A3D11_ = true;
                        $config["proxy-groups"][$k]["proxies"] = array_values(array_diff($config["proxy-groups"][$k]["proxies"], [$_obfuscated_0D0F032F26080C37235C3F312C1540052208240F020322_]));
                        if($this->isMatch($_obfuscated_0D0F032F26080C37235C3F312C1540052208240F020322_, $_obfuscated_0D08015C120F0223131F32060C39163B5B395B3B193822_)) {
                            array_push($config["proxy-groups"][$k]["proxies"], $_obfuscated_0D08015C120F0223131F32060C39163B5B395B3B193822_);
                        }
                    }
                }
                if($_obfuscated_0D051937041E2737371906062237123E2E3F33232A3D11_) {
                }
            }
            if($_obfuscated_0D051937041E2737371906062237123E2E3F33232A3D11_) {
            } else {
                $config["proxy-groups"][$k]["proxies"] = array_merge($config["proxy-groups"][$k]["proxies"], $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_);
            }
        }
        $config["proxy-groups"] = array_filter($config["proxy-groups"], function ($group) {
            return $group["proxies"];
        });
        $config["proxy-groups"] = array_values($config["proxy-groups"]);
        $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_ = $_SERVER["HTTP_HOST"];
        if($_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_) {
            array_unshift($config["rules"], "DOMAIN," . $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_ . ",DIRECT");
        }
        $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_ = \Symfony\Component\Yaml\Yaml::dump($config, 2, 4, \Symfony\Component\Yaml\Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
        $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_ = str_replace("\$app_name", config("aikopanel.app_name", "AikoPanel"), $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_);
        return $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_;
    }
    public static function buildShadowsocks($uuid, $server)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "ss";
        $array["server"] = gethostbyname($server["host"]);
        $array["port"] = $server["port"];
        $array["cipher"] = $server["cipher"];
        $array["password"] = $uuid;
        $array["udp"] = true;
        return $array;
    }
    public static function buildVmess($uuid, $server, $sni)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "vmess";
        $array["server"] = gethostbyname($server["host"]);
        $array["port"] = $server["port"];
        $array["uuid"] = $uuid;
        $array["alterId"] = 0;
        $array["cipher"] = "auto";
        $array["udp"] = true;
        if($server["tls"]) {
            $array["tls"] = true;
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    $array["skip-cert-verify"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? true : false;
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    $array["servername"] = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
                }
            }
        }
        if($server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $array["network"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"])) {
                    $array["http-opts"]["headers"]["Host"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"];
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"])) {
                    $array["http-opts"]["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
                }
            }
        }
        if($server["network"] === "ws") {
            $array["network"] = "ws";
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                $array["ws-opts"] = [];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["ws-opts"]["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["ws-opts"]["headers"] = ["Host" => $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
            }
        }
        if($server["network"] === "grpc") {
            $array["network"] = "grpc";
            if($server["networkSettings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
                $array["grpc-opts"] = [];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["grpc-opts"]["grpc-service-name"] = $sni ?? $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        return $array;
    }
    public static function buildVless($uuid, $server, $sni)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "vless";
        $array["server"] = gethostbyname($server["host"]);
        $array["port"] = $server["port"];
        $array["uuid"] = $uuid;
        $array["udp"] = true;
        if($server["tls"]) {
            $array["tls"] = true;
            $array["skip-cert-verify"] = isset($server["tls_settings"]["allow_insecure"]) && $server["tls_settings"]["allow_insecure"] == 1 ? true : false;
            $array["flow"] = !empty($server["flow"]) ? $server["flow"] : "";
            $array["client-fingerprint"] = !empty($server["tls_settings"]["fingerprint"]) ? $server["tls_settings"]["fingerprint"] : "chrome";
            if($server["tls_settings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                    $array["servername"] = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
                }
                if($server["tls"] == 2) {
                    $array["reality-opts"] = [];
                    $array["reality-opts"]["public-key"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["public_key"];
                    $array["reality-opts"]["short-id"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["short_id"];
                }
            }
        }
        if($server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["network_settings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $array["network"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"])) {
                    $array["http-opts"]["headers"]["Host"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"];
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"])) {
                    $array["http-opts"]["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
                }
            }
        }
        if($server["network"] === "ws") {
            $array["network"] = "ws";
            if($server["network_settings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
                $array["ws-opts"] = [];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["ws-opts"]["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["ws-opts"]["headers"] = ["Host" => $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
            }
        }
        if($server["network"] === "grpc") {
            $array["network"] = "grpc";
            if($server["network_settings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
                $array["grpc-opts"] = [];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["grpc-opts"]["grpc-service-name"] = $sni ?? $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        if($server["network"] === "h2") {
            $array["network"] = "h2";
            if($server["network_settings"]) {
                $_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_ = $server["network_settings"];
                $array["h2-opts"] = [];
                if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"])) {
                    $array["h2-opts"]["host"] = $sni ?? [$_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"]];
                }
                if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"])) {
                    $array["h2-opts"]["path"] = $_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"];
                }
            }
        }
        return $array;
    }
    public static function buildTrojan($password, $server, $sni)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "trojan";
        $array["server"] = gethostbyname($server["host"]);
        $array["port"] = $server["port"];
        $array["password"] = $password;
        $array["udp"] = true;
        if(isset($server["network"]) && in_array($server["network"], ["grpc", "ws"])) {
            $array["network"] = $server["network"];
            if($server["network"] === "grpc" && isset($server["network_settings"]["serviceName"])) {
                $array["grpc-opts"]["grpc-service-name"] = $sni ?? $server["network_settings"]["serviceName"];
            }
            if($server["network"] === "ws") {
                if(isset($server["network_settings"]["path"])) {
                    $array["ws-opts"]["path"] = $server["network_settings"]["path"];
                }
                if(isset($server["network_settings"]["headers"]["Host"])) {
                    $array["ws-opts"]["headers"]["Host"] = $sni ?? $server["network_settings"]["headers"]["Host"];
                }
            }
        }
        if(!empty($server["server_name"])) {
            $array["sni"] = $sni ?? $server["server_name"];
        }
        if(!empty($server["allow_insecure"])) {
            $array["skip-cert-verify"] = $server["allow_insecure"] ? true : false;
        }
        return $array;
    }
    public static function buildHysteria($password, $server, $sni)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["server"] = $server["host"];
        $array["port"] = $server["port"];
        $array["udp"] = true;
        $array["skip-cert-verify"] = $server["insecure"] == 1 ? true : false;
        if(isset($server["server_name"])) {
            $array["sni"] = $sni ?? $server["server_name"];
        }
        if($server["version"] === 2) {
            $array["type"] = "hysteria2";
            $array["password"] = $password;
            if(isset($server["obfs"])) {
                $array["obfs"] = $server["obfs"];
                $array["obfs-password"] = $server["obfs_password"];
            }
        } else {
            $array["type"] = "hysteria";
            $array["auth_str"] = $password;
            if(isset($server["obfs"]) && isset($server["obfs_password"])) {
                $array["obfs"] = $server["obfs_password"];
            }
            $array["up"] = $server["down_mbps"];
            $array["down"] = $server["up_mbps"];
            $array["protocol"] = "udp";
        }
        return $array;
    }
    private function isMatch($exp, $str)
    {
        return @preg_match($exp, $str);
    }
    private function isRegex($exp)
    {
        return @preg_match($exp, NULL) !== false;
    }
}

?>