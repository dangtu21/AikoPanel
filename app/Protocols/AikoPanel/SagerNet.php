<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class SagerNet
{
    public $flag = "sagernet";
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
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVless($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
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
    public static function buildVmess($uuid, $server, $sni)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["encryption" => "none", "type" => urlencode($server["network"]), "security" => $server["tls"] ? "tls" : ""];
        if($server["tls"] && $server["tlsSettings"]) {
            $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = urlencode($sni) ?? urlencode($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]);
            }
        }
        if((string) $server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["type"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0];
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0];
                }
            }
        }
        if((string) $server["network"] === "ws") {
            $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
            }
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = urlencode($sni) ?? urlencode($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
            }
        }
        if((string) $server["network"] === "grpc") {
            $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["serviceName"] = urlencode($sni) ?? urlencode($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]);
            }
        }
        return "vmess://" . $uuid . "@" . $server["host"] . ":" . $server["port"] . "?" . http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_) . "#" . urlencode($server["name"]) . "\r\n";
    }
    public static function buildVless($uuid, $server, $sni)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["name" => \App\Utils\Helper::encodeURIComponent($server["name"]), "add" => $server["host"], "port" => (string) $server["port"], "type" => $server["network"], "encryption" => "none", "host" => "", "path" => "", "headerType" => "none", "quicSecurity" => "none", "serviceName" => "", "mode" => "gun", "security" => $server["tls"] != 0 ? $server["tls"] == 2 ? "reality" : "tls" : "", "flow" => $server["flow"], "fp" => isset($server["tls_settings"]["fingerprint"]) ? $server["tls_settings"]["fingerprint"] : "chrome", "sni" => "", "pbk" => "", "sid" => ""];
        $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ = "vless://" . $uuid . "@" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["add"] . ":" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["port"];
        $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "?" . "type=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["type"] . "&encryption=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["encryption"] . "&security=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["security"];
        if($server["tls"]) {
            if($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["flow"] != "") {
                $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&flow=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["flow"];
            }
            if($server["tls_settings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
                }
                $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&sni=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"];
                if($server["tls"] == 2) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["pbk"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["public_key"];
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sid"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["short_id"];
                    $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&pbk=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["pbk"] . "&sid=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sid"];
                }
            }
        }
        if((string) $server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["network_settings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0];
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0];
                }
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&headerType=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"] . "&host=" . $sni ?? "&host=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] . "&seed=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"];
        }
        if((string) $server["network"] === "kcp") {
            $_obfuscated_0D1B053821123B2F400937400B1D323808142C02123B01_ = $server["network_settings"];
            if(isset($_obfuscated_0D1B053821123B2F400937400B1D323808142C02123B01_["header"]["type"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"] = $_obfuscated_0D1B053821123B2F400937400B1D323808142C02123B01_["header"]["type"];
            }
            if(isset($_obfuscated_0D1B053821123B2F400937400B1D323808142C02123B01_["seed"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D1B053821123B2F400937400B1D323808142C02123B01_["seed"]);
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&headerType=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"] . "&seed=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"];
        }
        if((string) $server["network"] === "ws") {
            $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
            }
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&path=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] . "&host=" . $sni ?? "&host=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"];
        }
        if((string) $server["network"] === "h2") {
            $_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_ = $server["network_settings"];
            if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["path"]);
            }
            if(isset($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D11260806032B2F1D0732050A394016192712052F1F11_["host"]);
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&path=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] . "&host=" . $sni ?? "&host=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"];
        }
        if((string) $server["network"] === "quic") {
            $_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_ = $server["network_settings"];
            if(isset($_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["security"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["quicSecurity"] = $_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["security"];
            }
            if(isset($_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["header"]["type"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"] = $_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["header"]["type"];
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&quicSecurity=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["quicSecurity"] . "&headerType=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["headerType"];
            if((string) $_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["security"] !== "none" && isset($_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["key"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D2831280E1B123E031739141C23052E38332404121301_["key"]);
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&key=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"];
        }
        if((string) $server["network"] === "grpc") {
            $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["network_settings"];
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["serviceName"] = \App\Utils\Helper::encodeURIComponent($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]);
            }
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["multiMode"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["mode"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["multiMode"] ? "multi" : "gun";
            }
            $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&serviceName=" . $sni ?? "&serviceName=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["serviceName"] . "&mode=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["mode"];
        }
        $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ .= "&fp=" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["fp"] . "#" . $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["name"];
        return $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_ . "\r\n";
    }
    public static function buildTrojan($password, $server, $sni)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $query = http_build_query(["allowInsecure" => $server["allow_insecure"], "peer" => $sni ?? $server["server_name"], "sni" => $sni ?? $server["server_name"]]);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "trojan://" . $password . "@" . $server["host"] . ":" . $server["port"] . "?" . $query;
        if(isset($server["network"]) && in_array($server["network"], ["grpc", "ws"])) {
            $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&type=" . $server["network"];
            if($server["network"] === "grpc" && isset($server["network_settings"]["serviceName"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "&serviceName=" . $sni ?? "&serviceName=" . $server["network_settings"]["serviceName"];
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
}

?>