<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Client\Protocols;

class Overdue
{
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function normal()
    {
        $_obfuscated_0D3F1602150C0D173E32051739241B1A1A235B07173922_ = \App\Utils\Helper::getOverdueMessage();
        $info = array_map(function ($message) {
            return $this->createExpiredServerResponse($message);
        }, $_obfuscated_0D3F1602150C0D173E32051739241B1A1A235B07173922_);
        return base64_encode(implode("", $info));
    }
    public function singbox()
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["outbounds"] = $this->buildsingbox();
        return json_encode($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_);
    }
    public function buildsingbox()
    {
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_ = [];
        $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_ = ["tag" => "Hết Hạn", "type" => "selector", "default" => "AikoPanel", "outbounds" => ["AikoPanel"]];
        $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_ = ["tag" => "AikoPanel", "type" => "urltest", "outbounds" => []];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] =& $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_;
        $_obfuscated_0D2E3D2A38180C0A3E5B39010F091B0701070438401401_ = \App\Utils\Helper::getOverdueMessage();
        foreach ($_obfuscated_0D2E3D2A38180C0A3E5B39010F091B0701070438401401_ as $message) {
            $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $this->createExpiredServerResponseXb($message);
            $_obfuscated_0D2205380F243B372811081E0210092B3529370B243801_["outbounds"][] = $message;
            $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_["outbounds"][] = $message;
        }
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "direct", "type" => "direct"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "block", "type" => "block"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = ["tag" => "dns-out", "type" => "dns"];
        $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_[] = $_obfuscated_0D25251209401111252C13041C0B1D3C0B0B16385B2D32_;
        return $_obfuscated_0D2E3D243C3C1828382912290C3B31093D163D055B1E22_;
    }
    private function createExpiredServerResponseXb($name)
    {
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_ = ["tag" => $name, "type" => "vmess", "server" => config("aikopanel.app_url"), "server_port" => 1080, "uuid" => "bf000d23-0752-40b4-affe-68f7707a9661", "security" => "auto"];
        return $config;
    }
    private function createExpiredServerResponse($name)
    {
        $config = ["v" => "2", "ps" => $name, "add" => config("aikopanel.app_url"), "port" => "443", "id" => "uuid-uuid-uuid-uuid-uuid", "net" => "tcp"];
        return "vmess://" . base64_encode(json_encode($config)) . "\r\n";
    }
}

?>