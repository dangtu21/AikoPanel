<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class Shadowrocket
{
    public $flag = "shadowrocket";
    private $servers;
    private $user;
    public function __construct($user, $servers)
    {
        $this->user = $user;
        $this->servers = $servers;
    }
    public function handle()
    {
        $servers = $this->servers;
        $user = $this->user;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "";
        $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ = round($user["u"] / 1073741824, 2);
        $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_ = round($user["d"] / 1073741824, 2);
        $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ = round($user["transfer_enable"] / 1073741824, 2);
        $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_ = date("Y-m-d", $user["expired_at"]);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "STATUS=🚀↑:" . $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ . "GB,↓:" . $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_ . "GB,TOT:" . $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ . "GB💡Expires:" . $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_ . "\r\n";
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVless($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "hysteria") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildHysteria($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
        }
        return base64_encode($_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_);
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
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($server["cipher"] . ":" . $password));
        return "ss://" . $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ . "@" . $server["host"] . ":" . $server["port"] . "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ . "\r\n";
    }
    public static function buildVmess($uuid, $server)
    {
        $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ = base64_encode("auto:" . $uuid . "@" . $server["host"] . ":" . $server["port"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["tfo" => 1, "remark" => $server["name"], "alterId" => 0];
        if($server["tls"]) {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["tls"] = 1;
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["allowInsecure"] = (int) $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"];
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["peer"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
                }
            }
        }
        if($server["network"] === "tcp" && $server["networkSettings"]) {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0];
            }
        }
        if($server["network"] === "ws") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "websocket";
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfsParam"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
            }
        }
        if($server["network"] === "grpc") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "grpc";
            if($server["networkSettings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]) && !empty($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_)) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
            } else {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $server["host"];
            }
        }
        $query = http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "", "&", PHP_QUERY_RFC3986);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "vmess://" . $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ . "?" . $query;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVless($uuid, $server)
    {
        $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ = base64_encode("auto:" . $uuid . "@" . $server["host"] . ":" . $server["port"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["tfo" => 1, "remark" => $server["name"], "alterId" => 0];
        if(isset($server["flow"]) && !blank($server["flow"])) {
            $_obfuscated_0D0F061737040B0815370C14042E022E1D1A122D1F0622_ = ["none" => 0, "xtls-rprx-direct" => 1, "xtls-rprx-vision" => 2];
            if(array_key_exists($server["flow"], $_obfuscated_0D0F061737040B0815370C14042E022E1D1A122D1F0622_)) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["tls"] = 1;
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["xtls"] = $_obfuscated_0D0F061737040B0815370C14042E022E1D1A122D1F0622_[$server["flow"]];
            }
        }
        if($server["tls"]) {
            switch ($server["tls"]) {
                case 1:
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["tls"] = 1;
                    if($server["tls_settings"]) {
                        $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                        if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["allowInsecure"] = (int) $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"];
                        }
                        if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["peer"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
                        }
                    }
                    break;
                case 2:
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["tls"] = 1;
                    $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_ = $server["tls_settings"];
                    if(($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"] ?? NULL)) {
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["pbk"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sid"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"];
                        $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_ = ["chrome", "firefox", "safari", "ios", "edge", "qq"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["fp"] = $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_[rand(0, count($_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_) - 1)];
                    }
                    break;
            }
        }
        if($server["network"] === "tcp" && $server["network_settings"]) {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["network_settings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"];
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfsParam"] = $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_[array_rand($_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_)];
            }
        }
        if($server["network"] === "ws") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "websocket";
            if($server["network_settings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfsParam"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
            }
        }
        if($server["network"] === "grpc") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "grpc";
            if($server["network_settings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]) && !empty($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_)) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
            } else {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $server["host"];
            }
        }
        $query = http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "", "&", PHP_QUERY_RFC3986);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "vless" . "://" . $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ . "?" . $query;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildTrojan($password, $server)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = ["allowInsecure" => $server["allow_insecure"], "peer" => $server["server_name"]];
        if(in_array($server["network"], ["grpc", "ws"])) {
            if($server["network"] === "grpc" && isset($server["networkSettings"]["serviceName"])) {
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["obfs"] = "grpc";
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["path"] = $server["networkSettings"]["serviceName"];
            }
            if($server["network"] === "ws") {
                $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = "";
                $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = "";
                if(isset($server["networkSettings"]["path"])) {
                    $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = $server["networkSettings"]["path"];
                }
                if(isset($server["networkSettings"]["headers"]["Host"])) {
                    $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $server["networkSettings"]["headers"]["Host"];
                }
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["plugin"] = "obfs-local;obfs=websocket;obfs-host=" . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ . ";obfs-uri=" . $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_;
            }
        }
        $query = http_build_query($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "trojan://" . $password . "@" . $server["host"] . ":" . $server["port"] . "?" . $query . "&tfo=1#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildHysteria($password, $server)
    {
        switch ($server["version"]) {
            case 1:
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = ["auth" => $password, "upmbps" => $server["up_mbps"], "downmbps" => $server["down_mbps"], "protocol" => "udp", "peer" => $server["server_name"], "fastopen" => 1, "alpn" => \App\Models\ServerHysteria::$alpnMap[$server["alpn"]]];
                if($server["is_obfs"]) {
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["obfs"] = "xplus";
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["obfsParam"] = $server["server_key"];
                }
                if($server["insecure"]) {
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["insecure"] = $server["insecure"];
                }
                $query = http_build_query($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "hysteria://" . $server["host"] . ":" . $server["port"] . "?" . $query . "#" . $server["name"];
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
                break;
            case 2:
                $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = ["peer" => $server["server_name"], "obfs" => "none", "fastopen" => 1];
                if($server["is_obfs"]) {
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["obfs-password"] = $server["server_key"];
                }
                if($server["insecure"]) {
                    $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["insecure"] = $server["insecure"];
                }
                $query = http_build_query($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "hysteria2://" . $password . "@" . $server["host"] . ":" . $server["port"] . "?" . $query . "#" . $server["name"];
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
                break;
            default:
                return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
        }
    }
}

?>