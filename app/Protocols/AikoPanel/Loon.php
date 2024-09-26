<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class Loon
{
    public $flag = "loon";
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
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "";
        header("Subscription-Userinfo: upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"]);
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks" && in_array($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["cipher"], ["aes-128-gcm", "aes-192-gcm", "aes-256-gcm", "chacha20-ietf-poly1305"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            } elseif($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVless($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
        }
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildShadowsocks($password, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=Shadowsocks", (string) $server["host"], (string) $server["port"], (string) $server["cipher"], (string) $password, "fast-open=false", "udp=true"];
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVmess($uuid, $server, $sni)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=vmess", (string) $server["host"], (string) $server["port"], "auto", (string) $uuid, "fast-open=false", "udp=true", "alterId=0"];
        if($server["network"] === "tcp") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "transport=tcp");
            if($server["networkSettings"]) {
                $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = str_replace("transport=tcp", "transport=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"], $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "path=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]);
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0]);
                }
            }
        }
        if($server["tls"]) {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "over-tls=true");
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "skip-cert-verify=" . ($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? "true" : "false"));
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "tls-name=" . $sni ?? "tls-name=" . $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]);
                }
            }
        }
        if($server["network"] === "ws") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "transport=ws");
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "path=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $sni ?? "host=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
                }
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVless($uuid, $server, $sni)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=vless", (string) $server["host"], (string) $server["port"], (string) $uuid, "fast-open=false", "udp=true", "alterId=0"];
        if($server["network"] === "tcp") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "transport=tcp");
            if($server["network_settings"]) {
                $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["network_settings"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"] == "http") {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = str_replace("transport=tcp", "transport=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"], $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "path=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]);
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0]);
                }
            }
        }
        if($server["tls"] === 1) {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "over-tls=true");
            if($server["network"] === "tcp" && $server["tls_settings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allow_insecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allow_insecure"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "skip-cert-verify=" . ($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allow_insecure"] ? "true" : "false"));
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "tls-name=" . $sni ?? "tls-name=" . $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]);
                }
            }
        } elseif($server["tls"] === 2) {
            return "";
        }
        if($server["network"] === "ws") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "transport=ws");
            if($server["network_settings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "path=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $sni ?? "host=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
                }
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildTrojan($password, $server, $sni)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["trojan=" . $server["host"] . ":" . $server["port"], "password=" . $password, $server["allow_insecure"] ? "tls-verification=false" : "tls-verification=true", "fast-open=true", "udp-relay=true", "tag=" . $server["name"]];
        $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $server["server_name"] ?? $server["host"];
        if($server["network"] === "ws") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs=wss");
            if($server["network_settings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["network_settings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs-uri=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs-host=" . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_);
            }
        } else {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "over-tls=true");
            if(isset($server["server_name"]) && !empty($server["server_name"])) {
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "tls-host=" . $server["server_name"]);
            }
        }
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>