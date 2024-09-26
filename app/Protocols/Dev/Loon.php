<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class Loon
{
    public $flag = "loon";
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
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks" && in_array($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["cipher"], ["aes-128-gcm", "aes-192-gcm", "aes-256-gcm", "chacha20-ietf-poly1305"])) {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "hysteria") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildHysteria($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $user);
            }
        }
        return response($_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_, 200)->header("Subscription-Userinfo", "upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"]);
    }
    public static function buildShadowsocks($password, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=Shadowsocks", (string) $server["host"], (string) $server["port"], (string) $server["cipher"], (string) $password, "fast-open=false", "udp=true"];
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVmess($uuid, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=vmess", (string) $server["host"], (string) $server["port"], "auto", (string) $uuid, "fast-open=false", "udp=true", "alterId=0"];
        if($server["network"] === "tcp") {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "transport=tcp");
            if($server["networkSettings"]) {
                $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"])) {
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = str_replace("transport=tcp", "transport=" . $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"], $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
                }
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0]) && !empty($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                    $_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"];
                }
                $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = array_rand(array_rand($_obfuscated_0D11183C2C323540141B243C300C10100D3B16262B3932_));
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "path=" . $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_);
                if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"][0])) {
                    $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_ = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["headers"]["Host"];
                    $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_[array_rand($_obfuscated_0D1E0912301435141A013F0A0C282B2F1C03052D403032_)];
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_);
                }
            }
        }
        if($server["tls"]) {
            if($server["network"] === "tcp") {
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "over-tls=true");
            }
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "skip-cert-verify=" . ($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? "true" : "false"));
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "tls-name=" . $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]);
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
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "host=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
                }
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildTrojan($password, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=trojan", (string) $server["host"], (string) $server["port"], (string) $password, $server["server_name"] ? "tls-name=" . $server["server_name"] : "", "fast-open=false", "udp=true"];
        if(!empty($server["allow_insecure"])) {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, $server["allow_insecure"] ? "skip-cert-verify=true" : "skip-cert-verify=false");
        }
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildHysteria($password, $server, $user)
    {
        if($server["version"] !== 2) {
            return NULL;
        }
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = [$server["name"] . "=Hysteria2", $server["host"], $server["port"], $password, $server["server_name"] ? "tls=" . $server["server_name"] : "(null)"];
        if($server["insecure"]) {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_[] = "skip-cert-verify=true";
        }
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_[] = "download-bandwidth=" . ($user->speed_limit ? min($server["down_mbps"], $user->speed_limit) : $server["down_mbps"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_[] = "udp=true";
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>