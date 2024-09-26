<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\Dev;

class Shadowsocks
{
    public $flag = "shadowsocks";
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
        $_obfuscated_0D0E2E1B3E0A1D28121517151E350232110F281C383232_ = [];
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_ = [];
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["servers"] = [];
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["bytes_used"] = "";
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["bytes_remaining"] = "";
        $_obfuscated_0D10264023071E0B1F1D062F301538220C3D2D17151732_ = $user["u"] + $user["d"];
        $_obfuscated_0D0F1A182C062F171913102F252B2C1D022136391E2E11_ = $user["transfer_enable"] - $_obfuscated_0D10264023071E0B1F1D062F301538220C3D2D17151732_;
        foreach ($servers as $_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_) {
            if($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["type"] === "shadowsocks" && in_array($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_["cipher"], ["aes-128-gcm", "aes-256-gcm", "aes-192-gcm", "chacha20-ietf-poly1305"])) {
                array_push($_obfuscated_0D0E2E1B3E0A1D28121517151E350232110F281C383232_, self::SIP008($_obfuscated_0D1E08373D0613281B195B10390B0A0113053B120E0601_, $user));
            }
        }
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["version"] = 1;
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["bytes_used"] = $_obfuscated_0D10264023071E0B1F1D062F301538220C3D2D17151732_;
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["bytes_remaining"] = $_obfuscated_0D0F1A182C062F171913102F252B2C1D022136391E2E11_;
        $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["servers"] = array_merge($_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["servers"] ? $_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_["servers"] : [], $_obfuscated_0D0E2E1B3E0A1D28121517151E350232110F281C383232_);
        return json_encode($_obfuscated_0D5C5C3036243605150A1431322A2B1E17152208162111_, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public static function SIP008($server, $user)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["id" => $server["id"], "remarks" => $server["name"], "server" => $server["host"], "server_port" => $server["port"], "password" => $user["uuid"], "method" => $server["cipher"]];
        return $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_;
    }
}

?>