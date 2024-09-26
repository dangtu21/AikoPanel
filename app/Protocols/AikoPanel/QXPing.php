<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class QXPing
{
    public $flag = "qxping";
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
        header("subscription-userinfo: upload=" . $user["u"] . "; download=" . $user["d"] . "; total=" . $user["transfer_enable"] . "; expire=" . $user["expired_at"]);
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
            }
        }
        return base64_encode($_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_);
    }
    public static function buildShadowsocks($password, $server)
    {
        $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ = gethostbyname($server["host"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["shadowsocks=" . $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ . ":" . $server["port"], "method=" . $server["cipher"], "password=" . $password, "fast-open=true", "udp-relay=true", "tag=" . $server["name"]];
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVmess($uuid, $server, $sni)
    {
        $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ = gethostbyname($server["host"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["vmess=" . $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ . ":" . $server["port"], "method=chacha20-poly1305", "password=" . $uuid, "fast-open=true", "udp-relay=true", "tag=" . $server["name"]];
        if($server["tls"]) {
            if($server["network"] === "tcp") {
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs=over-tls");
            }
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "tls-verification=" . ($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? "false" : "true"));
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $sni ?? $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
                }
            }
        }
        if($server["network"] === "ws") {
            if($server["tls"]) {
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs=wss");
            } else {
                array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs=ws");
            }
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs-uri=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !isset($_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_)) {
                    $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $sni ?? $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
                }
            }
        }
        if(isset($_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_)) {
            array_push($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_, "obfs-host=" . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_);
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildTrojan($password, $server, $sni)
    {
        $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ = gethostbyname($server["host"]);
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["trojan=" . $_obfuscated_0D13032F050A0F3D0D0D232236073C3F3D04151D3F1A22_ . ":" . $server["port"], "password=" . $password, "over-tls=true", $server["server_name"] ? "tls-host=" . $sni : "tls-host=" . $server["server_name"], $server["allow_insecure"] ? "tls-verification=false" : "tls-verification=true", "fast-open=true", "udp-relay=true", "tag=" . $server["name"]];
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = array_filter($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>