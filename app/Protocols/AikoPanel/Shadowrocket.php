<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class Shadowrocket
{
    public $flag = "shadowrocket";
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
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "";
        $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_ = $this->custom_sni ?? $user["sni"] ?? NULL;
        $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ = $this->formatTraffic($user["transfer_enable"]);
        $_obfuscated_0D212118275B08182F353628311A023C29062C3B072122_ = $this->formatTraffic($user["u"] + $user["d"]);
        $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_ = $user["expired_at"] ? date("d-m-Y", $user["expired_at"]) : "Vĩnh viễn";
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "STATUS=⛔HSD:" . $_obfuscated_0D151129232B3B0D360330174027043D3C133B22081022_ . " ✅ Dùng: " . $_obfuscated_0D212118275B08182F353628311A023C29062C3B072122_ . "/" . $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ . "\r\n";
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= $this->buildUri($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
        }
        return base64_encode($_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_);
    }
    private function formatTraffic($bytes)
    {
        $_obfuscated_0D3118073E0B3C191001242D5B5C0A0F40390D3E2A0222_ = $bytes / 1073741824;
        if($_obfuscated_0D3118073E0B3C191001242D5B5C0A0F40390D3E2A0222_ < 1) {
            $_obfuscated_0D2B1407155C17314036375B3B110231071A393D350611_ = $_obfuscated_0D3118073E0B3C191001242D5B5C0A0F40390D3E2A0222_ * 1024;
            return number_format($_obfuscated_0D2B1407155C17314036375B3B110231071A393D350611_, 2, ",", ".") . " MB";
        }
        return number_format($_obfuscated_0D3118073E0B3C191001242D5B5C0A0F40390D3E2A0222_, 2, ",", ".") . " GB";
    }
    private function buildUri($uuid, $serverItem, $sni)
    {
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "";
        switch ($serverItem["type"]) {
            case "shadowsocks":
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = self::buildShadowsocks($uuid, $serverItem);
                break;
            case "vmess":
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = self::buildVmess($uuid, $serverItem, $sni);
                break;
            case "vless":
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = self::buildVless($uuid, $serverItem, $sni);
                break;
            case "trojan":
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = self::buildTrojan($uuid, $serverItem, $sni);
                break;
            case "hysteria":
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = self::buildHysteria($uuid, $serverItem, $sni);
                break;
            default:
                return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
        }
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
    public static function buildVmess($uuid, $server, $sni)
    {
        $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ = base64_encode("auto:" . $uuid . "@" . $server["host"] . ":" . $server["port"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["tfo" => 0, "remark" => $server["name"], "alterId" => 0];
        if($server["tls"]) {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["tls"] = 1;
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["allowInsecure"] = (int) $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"];
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["peer"] = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
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
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs-host"] = $sni ?? $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0];
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
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfsParam"] = $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
            }
        }
        if($server["network"] === "grpc") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "grpc";
            if($server["networkSettings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]) && !empty($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $sni ?? $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
                }
            }
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_)) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
            } else {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $sni ?? $server["host"];
            }
        }
        $query = http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "", "&", PHP_QUERY_RFC3986);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "vmess://" . $_obfuscated_0D04142A0A5C1E301E3F1E3F5B1928013D1F3019243422_ . "?" . $query;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVless($uuid, $server, $sni)
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
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfsParam"] = $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
            }
        }
        if($server["network"] === "grpc") {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["obfs"] = "grpc";
            if($server["network_settings"]) {
                $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
                if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]) && !empty($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $sni ?? $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
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
    public static function buildTrojan($password, $server, $sni)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $query = http_build_query(["allowInsecure" => $server["allow_insecure"], "peer" => $sni ?? $server["server_name"], "sni" => $sni ?? $server["server_name"]]);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "trojan://" . $password . "@" . $server["host"] . ":" . $server["port"] . "?" . $query;
        if(isset($server["network"]) && in_array($server["network"], ["grpc", "ws"])) {
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&type=" . $server["network"];
            if($server["network"] === "grpc" && isset($server["network_settings"]["serviceName"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&serviceName=" . $server["network_settings"]["serviceName"];
            }
            if($server["network"] === "ws") {
                if(isset($server["network_settings"]["path"])) {
                    $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&path=" . $server["network_settings"]["path"];
                }
                if(isset($server["network_settings"]["headers"]["Host"])) {
                    $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&host=" . $sni ?? "&host=" . $server["network_settings"]["headers"]["Host"];
                }
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ . "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildHysteria($password, $server, $sni)
    {
        $_obfuscated_0D2D170838392E350133132336151D01043607353E1E32_ = filter_var($server["host"], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? "[" . $server["host"] . "]" : $server["host"];
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = \App\Utils\Helper::encodeURIComponent($server["name"]);
        if($sni !== NULL) {
            $server["server_name"] = $sni;
        }
        if($server["version"] == 2) {
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "hysteria2://" . $password . "@" . $_obfuscated_0D2D170838392E350133132336151D01043607353E1E32_ . ":" . $server["port"] . "/?insecure=" . $server["insecure"] . "&sni=" . $server["server_name"];
            if(isset($server["obfs"]) && isset($server["obfs-password"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&obfs=" . $server["obfs"] . "&obfs-password=" . $server["obfs-password"];
            }
        } else {
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "hysteria://" . $_obfuscated_0D2D170838392E350133132336151D01043607353E1E32_ . ":" . $server["port"] . "/?";
            $query = http_build_query(["protocol" => "udp", "auth" => $password, "insecure" => $server["insecure"], "peer" => $server["server_name"], "upmbps" => $server["down_mbps"], "downmbps" => $server["up_mbps"]]);
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= $query;
            if(isset($server["obfs"]) && isset($server["obfs-password"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&obfs=" . $server["obfs"] . "&obfsParam" . $server["obfs-password"];
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ . "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>