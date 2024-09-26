<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class SagerNet
{
    public $flag = "sagernet";
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
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
            }
        }
        return base64_encode($_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_);
    }
    public static function buildShadowsocks($uuid, $server)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($server["cipher"] . ":" . $uuid));
        return "ss://" . $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ . "@" . $server["host"] . ":" . $server["port"] . "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ . "\r\n";
    }
    public static function buildShadowsocksSIP008($uuid, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["id" => $server["id"], "remarks" => $server["name"], "server" => $server["host"], "server_port" => $server["port"], "password" => $uuid, "method" => $server["cipher"]];
        return $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_;
    }
    public static function buildVmess($uuid, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["encryption" => "none", "type" => urlencode($server["network"]), "security" => $server["tls"] ? "tls" : ""];
        if($server["tls"] && $server["tlsSettings"]) {
            $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = urlencode($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]);
            }
        }
        if((string) $server["network"] === "tcp") {
            $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["type"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["type"];
            }
            if(isset($_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3F0127381F133007280319221D250C290D0A0A352B11_["header"]["request"]["path"][0];
            }
        }
        if((string) $server["network"] === "ws") {
            $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
            }
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = urlencode($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
            }
        }
        if((string) $server["network"] === "grpc") {
            $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["serviceName"] = urlencode($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"]);
            }
        }
        return "vmess://" . $uuid . "@" . $server["host"] . ":" . $server["port"] . "?" . http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_) . "#" . urlencode($server["name"]) . "\r\n";
    }
    public static function buildTrojan($uuid, $server)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $query = http_build_query(["allowInsecure" => $server["allow_insecure"], "peer" => $server["server_name"], "sni" => $server["server_name"]]);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "trojan://" . $uuid . "@" . $server["host"] . ":" . $server["port"] . "?" . $query . "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>