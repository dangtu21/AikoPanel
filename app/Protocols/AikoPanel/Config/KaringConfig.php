<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel\Config;

class KaringConfig
{
    public $flag = "sing-box";
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function handle()
    {
        $user = $this->user;
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["log"] = $this->LogConfigDefault();
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["dns"] = $this->DnsConfigDefault();
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["route"] = $this->RouteConfigDefault();
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["inbounds"] = $this->IboundsConfigDefault();
        $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["experimental"] = $this->ExperimentalConfigDefault();
        return $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_;
    }
    protected function LogConfigDefault()
    {
        $_obfuscated_0D070F3F0F0D0E061004271B33222C2A252B2525052D01_ = ["level" => "info", "timestamp" => true];
        return $_obfuscated_0D070F3F0F0D0E061004271B33222C2A252B2525052D01_;
    }
    protected function DnsConfigDefault()
    {
        return ["servers" => [["tag" => "proxyDns", "address" => "8.8.8.8", "detour" => "Lựa chọn nút"], ["tag" => "localDns", "address" => "local", "strategy" => "ipv4_only", "detour" => "direct"], ["tag" => "block", "address" => "rcode://success"]], "rules" => [["outbound" => "any", "server" => "localDns", "disable_cache" => true], ["query_type" => ["A", "AAAA"], "server" => "Lựa chọn nút"]], "independent_cache" => true, "strategy" => "ipv4_only"];
    }
    protected function RouteConfigDefault()
    {
        return ["auto_detect_interface" => true, "override_android_vpn" => true, "final" => "Lựa chọn nút", "rules" => [["protocol" => "dns", "outbound" => "dns-out"], ["inbound" => ["dns-in"], "outbound" => "dns-out"], ["outbound" => "dns-out", "port" => [53]], ["ip_cidr" => ["224.0.0.0/3", "ff00::/8"], "outbound" => "block", "source_ip_cidr" => ["224.0.0.0/3", "ff00::/8"]]]];
    }
    protected function ExperimentalConfigDefault()
    {
        return ["cache_file" => ["enabled" => true, "path" => "", "cache_id" => "", "store_fakeip" => false]];
    }
    protected function IboundsConfigDefault()
    {
        return [["type" => "tun", "tag" => "tun-in", "interface_name" => "tun0", "inet4_address" => "172.19.0.1/30", "mtu" => 1300, "auto_route" => true, "strict_route" => true, "stack" => "system", "endpoint_independent_nat" => false, "sniff" => false], ["listen" => "0.0.0.0", "listen_port" => 2080, "sniff" => false, "tag" => "mixed-in", "type" => "mixed"]];
    }
}

?>