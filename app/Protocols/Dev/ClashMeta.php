<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class ClashMeta
{
    public $flag = "meta,verge";
    private $servers;
    private $user;
    public function __construct($user, $servers, array $options = NULL)
    {
        $this->user = $user;
        $this->servers = $servers;
    }
    public function handle()
    {
        $servers = $this->servers;
        $user = $this->user;
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = config("aikopanel.app_name", "AikoPanel");
        $_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_ = base_path() . "/resources/rules/custom.clash.yaml";
        if(\File::exists($_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_)) {
            $config = \Symfony\Component\Yaml\Yaml::parseFile($_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_);
        } else {
            $config = \App\Protocols\AikoPanel\Config\ClashConfig::getDefaultConfig();
        }
        $_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_ = [];
        $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ = [];
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildVless($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_));
                array_push($_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"]);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "hysteria") {
                array_push($_obfuscated_0D39181C22192A263B332B29132D140B250414035C1A11_, self::buildHysteria($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $user));
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
        $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_ = request()->header("Host");
        if($_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_) {
            array_unshift($config["rules"], "DOMAIN," . $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_ . ",DIRECT");
        }
        $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_ = \Symfony\Component\Yaml\Yaml::dump($config, 2, 4, \Symfony\Component\Yaml\Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
        $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_ = str_replace("\$app_name", config("aikopanel.app_name", "AikoPanel"), $_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_);
        return response($_obfuscated_0D40113B3F0D2F1A382A2D2D0131091E2E3F022F3D1011_, 200)->header("subscription-userinfo", "upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"])->header("profile-update-interval", "24")->header("content-disposition", "attachment;filename*=UTF-8''" . rawurlencode($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_));
    }
    public static function buildShadowsocks($password, $server)
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
        $array["name"] = $server["name"];
        $array["type"] = "ss";
        $array["server"] = $server["host"];
        $array["port"] = $server["port"];
        $array["cipher"] = $server["cipher"];
        $array["password"] = $password;
        $array["udp"] = true;
        return $array;
    }
    public static function buildVmess($uuid, $server)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "vmess";
        $array["server"] = $server["host"];
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
                    $array["servername"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
                }
            }
        }
        if($server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"])) {
                $array["network"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"])) {
                $_obfuscated_0D372F1E3B5C5B3B31220E0C4009032B5C3D3121021011_ = ${$_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_}["header"]["request"]["headers"];
                $array["http-opts"]["headers"] = $_obfuscated_0D372F1E3B5C5B3B31220E0C4009032B5C3D3121021011_;
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                $_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
                $array["http-opts"]["path"] = $_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_;
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
                    $array["ws-opts"]["headers"] = ["Host" => $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["ws-path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["ws-headers"] = ["Host" => $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
            }
        }
        if($server["network"] === "grpc") {
            $array["network"] = "grpc";
            if($server["networkSettings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
                $array["grpc-opts"] = [];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["grpc-opts"]["grpc-service-name"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        return $array;
    }
    public static function buildVless($password, $server)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "vless";
        $array["server"] = $server["host"];
        $array["port"] = $server["port"];
        $array["uuid"] = $password;
        $array["alterId"] = 0;
        $array["cipher"] = "auto";
        $array["udp"] = true;
        if($server["flow"]) {
            $array["flow"] = $server["flow"];
        }
        if($server["tls"]) {
            switch ($server["tls"]) {
                case 1:
                    $array["tls"] = true;
                    if($server["tls_settings"]) {
                        $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                        if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                            $array["skip-cert-verify"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? true : false;
                        }
                        if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                            $array["servername"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
                        }
                    }
                    break;
                case 2:
                    $array["tls"] = true;
                    $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_ = $server["tls_settings"];
                    if(!empty($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["allowInsecure"])) {
                        $array["skip-cert-verify"] = (bool) $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["allowInsecure"];
                    }
                    if(($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"] ?? NULL)) {
                        $array["servername"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"];
                        $array["reality-opts"] = ["public-key" => $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"], "short-id" => $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"]];
                        $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_ = ["chrome", "firefox", "safari", "ios", "edge", "qq"];
                        $array["client-fingerprint"] = $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_[rand(0, count($_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_) - 1)];
                    }
                    break;
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
                    $array["ws-opts"]["headers"] = ["Host" => $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $array["ws-path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $array["ws-headers"] = ["Host" => $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]];
                }
            }
        }
        if($server["network"] === "grpc") {
            $array["network"] = "grpc";
            if($server["network_settings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
                $array["grpc-opts"] = [];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $array["grpc-opts"]["grpc-service-name"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
        }
        return $array;
    }
    public static function buildTrojan($password, $server)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["type"] = "trojan";
        $array["server"] = $server["host"];
        $array["port"] = $server["port"];
        $array["password"] = $password;
        $array["udp"] = true;
        if(!empty($server["server_name"])) {
            $array["sni"] = $server["server_name"];
        }
        if(!empty($server["allow_insecure"])) {
            $array["skip-cert-verify"] = $server["allow_insecure"] ? true : false;
        }
        if(in_array($server["network"], ["grpc", "ws"])) {
            $array["network"] = $server["network"];
            if($server["network"] === "grpc" && isset($server["networkSettings"]["serviceName"])) {
                $array["grpc-opts"]["grpc-service-name"] = $server["networkSettings"]["serviceName"];
            }
            if($server["network"] === "ws") {
                if(isset($server["networkSettings"]["path"])) {
                    $array["ws-opts"]["path"] = $server["networkSettings"]["path"];
                }
                if(isset($server["networkSettings"]["headers"]["Host"])) {
                    $array["ws-opts"]["headers"]["Host"] = $server["networkSettings"]["headers"]["Host"];
                }
            }
        }
        return $array;
    }
    public static function buildHysteria($password, $server, $user)
    {
        $array = [];
        $array["name"] = $server["name"];
        $array["server"] = $server["host"];
        $array["port"] = $server["port"];
        if($server["server_name"]) {
            $array["sni"] = $server["server_name"];
        }
        $array["up"] = $user->speed_limit ? min($server["up_mbps"], $user->speed_limit) : $server["up_mbps"];
        $array["down"] = $user->speed_limit ? min($server["down_mbps"], $user->speed_limit) : $server["down_mbps"];
        $array["skip-cert-verify"] = $server["insecure"] ? true : false;
        switch ($server["version"]) {
            case 1:
                $array["type"] = "hysteria";
                if(isset($server["ports"])) {
                    $array["ports"] = $server["ports"];
                }
                $array["auth_str"] = $password;
                $array["protocol"] = "udp";
                if($server["is_obfs"]) {
                    $array["obfs"] = $server["server_key"];
                }
                $array["fast-open"] = true;
                $array["disable_mtu_discovery"] = true;
                $array["alpn"] = [new \App\Models\ServerHysteria::$alpnMap[$server["alpn"]]()];
                break;
            case 2:
                $array["type"] = "hysteria2";
                $array["password"] = $password;
                if($server["is_obfs"]) {
                    $array["obfs"] = "salamander";
                    $array["obfs-password"] = $server["server_key"];
                }
                break;
            default:
                return $array;
        }
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