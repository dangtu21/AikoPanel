<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel\Config;

class SingBoxConfig
{
    public $flag = "sing-box";
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    public function handle()
    {
        $_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_ = $this->user["username"] ?? config("aikopanel.app_name", "AikoPanel");
        $_obfuscated_0D1A033F320C221B212308381B213B01092A0F1B342511_ = config("aikopanel.advanced_singbox_config");
        switch ($_obfuscated_0D1A033F320C221B212308381B213B01092A0F1B342511_) {
            case "xb":
                $config["dns"] = $this->DnsXB($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_);
                $config["route"] = $this->RouteXB($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_);
                $config["inbounds"] = $this->InboundsXB();
                $config["experimental"] = $this->ExperimentalXB();
                break;
            default:
                $config["log"] = $this->LogConfigDefault();
                $config["dns"] = $this->DnsConfigDefault($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_);
                $config["route"] = $this->RouteConfigDefault($_obfuscated_0D251C01371F2C37400421141C1503261A2E2B1D3C3911_);
                $config["inbounds"] = $this->IboundsConfigDefault();
                $config["experimental"] = $this->ExperimentalConfigDefault();
                return $config;
        }
    }
    public function DnsXB($appName)
    {
        return ["rules" => [["outbound" => ["any"], "server" => "local"], ["disable_cache" => true, "geosite" => ["category-ads-all"], "server" => "block"], ["clash_mode" => "global", "server" => "remote"], ["clash_mode" => "direct", "server" => "local"], ["geosite" => "cn", "server" => "local"]], "servers" => [["address" => "https://1.1.1.1/dns-query", "detour" => (string) $appName, "tag" => "remote"], ["address" => "https://223.5.5.5/dns-query", "detour" => "direct", "tag" => "local"], ["address" => "rcode://success", "tag" => "block"]], "strategy" => "prefer_ipv4"];
    }
    public function ExperimentalXB()
    {
        return ["clash_api" => ["external_controller" => "127.0.0.1:9090", "secret" => ""]];
    }
    public function InboundsXB()
    {
        return [["auto_route" => true, "domain_strategy" => "prefer_ipv4", "endpoint_independent_nat" => true, "inet4_address" => "172.19.0.1/30", "inet6_address" => "2001:0470:f9da:fdfa::1/64", "mtu" => 9000, "sniff" => true, "sniff_override_destination" => true, "stack" => "system", "strict_route" => true, "type" => "tun"], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2333, "sniff" => true, "sniff_override_destination" => true, "tag" => "socks-in", "type" => "socks", "users" => []], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2334, "sniff" => true, "sniff_override_destination" => true, "tag" => "mixed-in", "type" => "mixed", "users" => []]];
    }
    public function RouteXB($appName)
    {
        return ["auto_detect_interface" => true, "rules" => [["geosite" => "category-ads-all", "outbound" => "block"], ["outbound" => "dns-out", "protocol" => "dns"], ["clash_mode" => "direct", "outbound" => "direct"], ["clash_mode" => "global", "outbound" => (string) $appName], ["geoip" => ["cn", "private"], "outbound" => "direct"], ["geosite" => "cn", "outbound" => "direct"]]];
    }
    protected function LogConfigDefault()
    {
        $_obfuscated_0D070F3F0F0D0E061004271B33222C2A252B2525052D01_ = ["level" => "info", "timestamp" => true];
        return $_obfuscated_0D070F3F0F0D0E061004271B33222C2A252B2525052D01_;
    }
    protected function DnsConfigDefault($appName)
    {
        return ["servers" => [["tag" => "proxyDns", "address" => "8.8.8.8", "detour" => $appName], ["tag" => "localDns", "address" => "local", "strategy" => "ipv4_only", "detour" => "direct"], ["tag" => "block", "address" => "rcode://success"]], "rules" => [["outbound" => "any", "server" => "localDns", "disable_cache" => true], ["query_type" => ["A", "AAAA"], "server" => $appName]], "independent_cache" => true, "strategy" => "ipv4_only"];
    }
    protected function RouteConfigDefault($appName)
    {
        return ["auto_detect_interface" => true, "override_android_vpn" => true, "final" => $appName, "rules" => [["protocol" => "dns", "outbound" => "dns-out"], ["inbound" => ["dns-in"], "outbound" => "dns-out"], ["outbound" => "dns-out", "port" => [53]], ["ip_cidr" => ["224.0.0.0/3", "ff00::/8"], "outbound" => "block", "source_ip_cidr" => ["224.0.0.0/3", "ff00::/8"]]]];
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