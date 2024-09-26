<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class SSRPlus
{
    public $flag = "ssrplus";
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
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vless") {
                $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= self::buildVless($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
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
    public static function buildShadowsocks($password, $server)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($server["cipher"] . ":" . $password));
        return "ss://" . $_obfuscated_0D1F084040091025030A24192C011F40012E1240341811_ . "@" . $server["host"] . ":" . $server["port"] . "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ . "\r\n";
    }
    public static function buildVmess($uuid, $server)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["v" => "2", "ps" => $server["name"], "add" => $server["host"], "port" => (string) $server["port"], "id" => $uuid, "aid" => "0", "net" => $server["network"], "type" => "none", "host" => "", "path" => "", "tls" => $server["tls"] ? "tls" : ""];
        if($server["tls"] && $server["tlsSettings"]) {
            $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
            if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"];
            }
        }
        if((string) $server["network"] === "ws") {
            $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
            }
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
            }
        }
        if((string) $server["network"] === "grpc") {
            $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
            }
        }
        return "vmess://" . base64_encode(json_encode($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_)) . "\r\n";
    }
    public static function buildVless($uuid, $server)
    {
        $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = $server["host"];
        $port = $server["port"];
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = $server["name"];
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["mode" => "multi", "security" => "", "encryption" => "none", "type" => $server["network"]];
        if($server["flow"]) {
            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["flow"] = $server["flow"];
        }
        if($server["tls"]) {
            switch ($server["tls"]) {
                case 1:
                    if($server["tls_settings"]) {
                        $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tls_settings"];
                        if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"])) {
                            $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["server_name"];
                        }
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["security"] = "tls";
                    }
                    break;
                case 2:
                    $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["security"] = "reality";
                    $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_ = $server["tls_settings"];
                    if(($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"] ?? NULL) && ($_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"] ?? NULL)) {
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["pbk"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["public_key"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sid"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["short_id"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["sni"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["servername"] = $_obfuscated_0D14161E2902213418231E2A2C342F241913172B031122_["server_name"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["spx"] = "/";
                        $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_ = ["chrome", "firefox", "safari", "ios", "edge", "qq"];
                        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["fp"] = $_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_[rand(0, count($_obfuscated_0D332F2E192F1D120F37053B1E121B13392D15151A1201_) - 1)];
                    }
                    break;
            }
        }
        if((string) $server["network"] === "ws") {
            $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["path"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"];
            }
            if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["host"] = $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"];
            }
        }
        if((string) $server["network"] === "grpc") {
            $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_ = $server["networkSettings"];
            if(isset($_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"])) {
                $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["serviceName"] = $_obfuscated_0D02035B261D3E1B3F085B062D1C1B2515291232043601_["serviceName"];
            }
        }
        $user = $uuid . "@" . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ . ":" . $port;
        $query = http_build_query($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
        $_obfuscated_0D3D5C1C1B2825373E182E07050209162C2B3527355B32_ = urlencode($_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_);
        $link = sprintf("vless://%s?%s#%s\r\n", $user, $query, $_obfuscated_0D3D5C1C1B2825373E182E07050209162C2B3527355B32_);
        return $link;
    }
    public static function buildTrojan($password, $server)
    {
        $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_ = rawurlencode($server["name"]);
        $query = http_build_query(["allowInsecure" => $server["allow_insecure"], "peer" => $server["server_name"], "sni" => $server["server_name"]]);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = "trojan://" . $password . "@" . $server["host"] . ":" . $server["port"] . "?" . $query . "#" . $_obfuscated_0D240A0514021D0E06340317112A2212241F29153E1F32_;
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>