<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Protocols\AikoPanel\Config;

class NekoBoxConfig
{
    public static function getDefaultConfig()
    {
        return ["mixed-port" => 7890, "allow-lan" => false, "mode" => "rule", "log-level" => "info", "global-client-fingerprint" => "firefox", "ipv6" => true, "proxy-groups" => [["name" => "\$app_name", "type" => "select", "proxies" => ["AikoPanel"]], ["name" => "AikoPanel", "type" => "fallback", "proxies" => [], "url" => "http://cp.cloudflare.com/", "interval" => 7200]], "sniffer" => ["enable" => true, "override-destination" => true, "sniffing" => ["tls", "http"]], "dns" => ["enable" => true, "listen" => "0.0.0.0:8853", "enhanced-mode" => "fake-ip", "fake-ip-range" => "198.18.0.1/16", "use-hosts" => true, "nameserver" => ["tls://1.1.1.1", "tls://1.0.0.1", "https://1.1.1.1/dns-query", "https://1.0.0.1/dns-query"], "ipv6" => true], "rules" => ["DOMAIN-SUFFIX,local,DIRECT", "IP-CIDR,127.0.0.0/8,DIRECT", "IP-CIDR,172.16.0.0/12,DIRECT", "IP-CIDR,192.168.0.0/16,DIRECT", "IP-CIDR,10.0.0.0/8,DIRECT", "IP-CIDR,17.0.0.0/8,DIRECT", "IP-CIDR,100.64.0.0/10,DIRECT", "IP-CIDR,224.0.0.0/4,DIRECT", "IP-CIDR6,fe80::/10,DIRECT", "MATCH,\$app_name"], "proxies" => []];
    }
}

?>