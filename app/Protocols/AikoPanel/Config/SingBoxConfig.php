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
        $user = $this->user;
        $_obfuscated_0D1A033F320C221B212308381B213B01092A0F1B342511_ = config("aikopanel.advanced_singbox_config");
        switch ($_obfuscated_0D1A033F320C221B212308381B213B01092A0F1B342511_) {
            case "xb":
                $config["dns"] = $this->DnsXB();
                $config["route"] = $this->RouteXB();
                $config["inbounds"] = $this->InboundsXB();
                $config["experimental"] = $this->ExperimentalXB();
                break;
            default:
                $config["log"] = $this->LogConfigDefault();
                $config["dns"] = $this->DnsConfigDefault();
                $config["route"] = $this->RouteConfigDefault();
                $config["inbounds"] = $this->IboundsConfigDefault();
                $config["experimental"] = $this->ExperimentalConfigDefault();
                return $config;
        }
    }
    public function DnsXB()
    {
        return ["rules" => [["outbound" => ["any"], "server" => "local"], ["disable_cache" => true, "geosite" => ["category-ads-all"], "server" => "block"], ["clash_mode" => "global", "server" => "remote"], ["clash_mode" => "direct", "server" => "local"], ["geosite" => "cn", "server" => "local"]], "servers" => [["address" => "https://1.1.1.1/dns-query", "detour" => "Lựa chọn nút", "tag" => "remote"], ["address" => "https://223.5.5.5/dns-query", "detour" => "direct", "tag" => "local"], ["address" => "rcode://success", "tag" => "block"]], "strategy" => "prefer_ipv4"];
    }
    public function ExperimentalXB()
    {
        return ["clash_api" => ["external_controller" => "127.0.0.1:9090", "secret" => ""]];
    }
    public function InboundsXB()
    {
        return [["auto_route" => true, "domain_strategy" => "prefer_ipv4", "endpoint_independent_nat" => true, "inet4_address" => "172.19.0.1/30", "inet6_address" => "2001:0470:f9da:fdfa::1/64", "mtu" => 9000, "sniff" => true, "sniff_override_destination" => true, "stack" => "system", "strict_route" => true, "type" => "tun"], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2333, "sniff" => true, "sniff_override_destination" => true, "tag" => "socks-in", "type" => "socks", "users" => []], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2334, "sniff" => true, "sniff_override_destination" => true, "tag" => "mixed-in", "type" => "mixed", "users" => []]];
    }
    public function RouteXB()
    {
        return ["auto_detect_interface" => true, "rules" => [["geosite" => "category-ads-all", "outbound" => "block"], ["outbound" => "dns-out", "protocol" => "dns"], ["clash_mode" => "direct", "outbound" => "direct"], ["clash_mode" => "global", "outbound" => "Lựa chọn nút"], ["geoip" => ["cn", "private"], "outbound" => "direct"], ["geosite" => "cn", "outbound" => "direct"]]];
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
        return ["cache_file" => ["enabled" => true, "path" => "", "cache_id" => "", "store_fakeip" => false], "clash_api" => ["external_controller" => "127.0.0.1:9090", "secret" => ""]];
    }
    protected function IboundsConfigDefault()
    {
        return [["type" => "tun", "tag" => "tun-in", "interface_name" => "tun0", "inet4_address" => "172.19.0.1/30", "inet6_address" => "2001:0470:f9da:fdfa::1/64", "mtu" => 9000, "auto_route" => true, "strict_route" => true, "stack" => "system", "endpoint_independent_nat" => true, "sniff" => true, "sniff_override_destination" => true, "domain_strategy" => "prefer_ipv4"], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2333, "sniff" => true, "sniff_override_destination" => true, "tag" => "socks-in", "type" => "socks", "users" => []], ["domain_strategy" => "prefer_ipv4", "listen" => "127.0.0.1", "listen_port" => 2334, "sniff" => true, "sniff_override_destination" => true, "tag" => "mixed-in", "type" => "mixed", "users" => []]];
    }
}

?>