<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel;

class Surfboard
{
    public $flag = "surfboard";
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
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = $user["username"] ?? \App\Utils\Helper::getAppNameById($user["id"]) ?? config("aikopanel.app_name", "AikoPanel");
        header("content-disposition:attachment;filename*=UTF-8''" . rawurlencode($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_) . ".conf");
        $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ = "";
        $_obfuscated_0D041B1A02010B23132A080E37090D30241D2D251F0222_ = "";
        $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_ = $this->custom_sni ?? $this->user["sni"] ?? NULL;
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks" && in_array($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["cipher"], ["aes-128-gcm", "aes-192-gcm", "aes-256-gcm", "chacha20-ietf-poly1305"])) {
                $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ .= self::buildShadowsocks($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_);
                $_obfuscated_0D041B1A02010B23132A080E37090D30241D2D251F0222_ .= $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"] . ", ";
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "vmess") {
                $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ .= self::buildVmess($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
                $_obfuscated_0D041B1A02010B23132A080E37090D30241D2D251F0222_ .= $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"] . ", ";
            }
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "trojan") {
                $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_ .= self::buildTrojan($user["uuid"], $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $_obfuscated_0D1630353D3740130B2A0817293E21263F17115B2C3022_);
                $_obfuscated_0D041B1A02010B23132A080E37090D30241D2D251F0222_ .= $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["name"] . ", ";
            }
        }
        $_obfuscated_0D083E1F141716160D3225055B265C0F09272D33290422_ = base_path() . "/resources/rules/default.surfboard.conf";
        $_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_ = base_path() . "/resources/rules/custom.surfboard.conf";
        if(\File::exists($_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_)) {
            $config = file_get_contents((string) $_obfuscated_0D2B1518331E1C271B1B1A2C111E384027333526352232_);
        } else {
            $config = file_get_contents((string) $_obfuscated_0D083E1F141716160D3225055B265C0F09272D33290422_);
        }
        $_obfuscated_0D33181135060C32263B16160F17123237023D0D173F32_ = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user["token"]);
        $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_ = $_SERVER["HTTP_HOST"];
        $config = str_replace("\$subs_link", $_obfuscated_0D33181135060C32263B16160F17123237023D0D173F32_, $config);
        $config = str_replace("\$subs_domain", $_obfuscated_0D36403D36341F2D0621032A141E2507330D182D071001_, $config);
        $config = str_replace("\$proxies", $_obfuscated_0D1C1A1C0429075C180D2A0F0302070E170B5B30251E11_, $config);
        $config = str_replace("\$proxy_group", rtrim($_obfuscated_0D041B1A02010B23132A080E37090D30241D2D251F0222_, ", "), $config);
        $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ = round($user["u"] / 1073741824, 2);
        $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_ = round($user["d"] / 1073741824, 2);
        $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ = $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ + $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_;
        $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ = round($user["transfer_enable"] / 1073741824, 2);
        $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_ = $user["expired_at"] === NULL ? "Vĩnh Viễn" : date("d-m-Y H:i:s", $user["expired_at"]);
        $_obfuscated_0D0B1809292327120A3E31371540021803390D0C2C2A32_ = "title=Thông tin đăng ký " . $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ . ", content=Upload: " . $_obfuscated_0D2502013B0B0509302E023C28210E223436092C043922_ . "GB\\nDownload: " . $_obfuscated_0D3E050B29350C122A07153B151C38325B0E112F1C3111_ . "GB\\nDung lượng còn lại: " . $_obfuscated_0D0E2E1D2203382603013E10193F2A0A035B18381F0332_ . "GB\\nDung lượng gói: " . $_obfuscated_0D0F150A31092116322E2E1533313D240101382D103932_ . "GB\\nNgày hết hạn: " . $_obfuscated_0D300635243701162D1E032E1C1E351E29270C1C233C11_;
        $config = str_replace("\$subscribe_info", $_obfuscated_0D0B1809292327120A3E31371540021803390D0C2C2A32_, $config);
        return $config;
    }
    public static function buildShadowsocks($password, $server)
    {
        $config = [$server["name"] . "=ss", (string) $server["host"], (string) $server["port"], "encrypt-method=" . $server["cipher"], "password=" . $password, "tfo=true", "udp-relay=true"];
        $config = array_filter($config);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $config);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildVmess($uuid, $server, $sni)
    {
        $config = [$server["name"] . "=vmess", (string) $server["host"], (string) $server["port"], "username=" . $uuid, "vmess-aead=true", "tfo=true", "udp-relay=true"];
        if($server["tls"]) {
            array_push($config, "tls=true");
            if($server["tlsSettings"]) {
                $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_ = $server["tlsSettings"];
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"])) {
                    array_push($config, "skip-cert-verify=" . ($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["allowInsecure"] ? "true" : "false"));
                }
                if(isset($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]) && !empty($_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"])) {
                    array_push($config, "sni=" . $sni ?? "sni=" . $_obfuscated_0D1C0F19150B050E143C1A1B33363F0C1D0A0831193032_["serverName"]);
                }
            }
        }
        if($server["network"] === "ws") {
            array_push($config, "ws=true");
            if($server["networkSettings"]) {
                $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_ = $server["networkSettings"];
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"])) {
                    array_push($config, "ws-path=" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["path"]);
                }
                if(isset($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]) && !empty($_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"])) {
                    array_push($config, "ws-headers=Host:" . $sni ?? "ws-headers=Host:" . $_obfuscated_0D3B1A310D1E0E300D5B32273306144019350811041632_["headers"]["Host"]);
                }
            }
        }
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $config);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
    public static function buildTrojan($password, $server, $sni)
    {
        $config = [$server["name"] . "=trojan", (string) $server["host"], (string) $server["port"], "password=" . $password, $server["server_name"] ? "sni=" . $sni : "sni=" . $server["server_name"], "tfo=true", "udp-relay=true"];
        if(!empty($server["allow_insecure"])) {
            array_push($config, $server["allow_insecure"] ? "skip-cert-verify=true" : "skip-cert-verify=false");
        }
        if(isset($server["network"]) && $server["network"] === "ws") {
            array_push($config, "ws=true");
            if(isset($server["network_settings"]["path"])) {
                array_push($config, "ws-path=" . $server["network_settings"]["path"]);
            }
            if(isset($server["network_settings"]["headers"]["Host"])) {
                array_push($config, "ws-headers=Host:" . $sni ?? "ws-headers=Host:" . $server["network_settings"]["headers"]["Host"]);
            }
        }
        $config = array_filter($config);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ = implode(",", $config);
        $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_ .= "\r\n";
        return $_obfuscated_0D080F380125280D29073C0B1631011E3D32180C1B1732_;
    }
}

?>