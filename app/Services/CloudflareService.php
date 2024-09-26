<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class CloudflareService
{
    protected $client;
    protected $zoneId;
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(["base_uri" => "https://api.cloudflare.com/client/v4/", "headers" => ["X-Auth-Email" => config("aikopanel.cloudflare_email") ?? env("CLOUDFLARE_EMAIL"), "X-Auth-Key" => config("aikopanel.cloudflare_api_key") ?? env("CLOUDFLARE_API_KEY"), "Content-Type" => "application/json"]]);
        $this->zoneId = config("aikopanel.cloudflare_zone_id") ?? env("CLOUDFLARE_ZONE_ID");
    }
    public function updateDnsRecord($recordName, $recordType, $recordContent)
    {
        try {
            $_obfuscated_0D08342F1604241E0B090F21210937351D3C1021313C32_ = $this->getDnsRecordId($recordName, $recordType);
            if(!$_obfuscated_0D08342F1604241E0B090F21210937351D3C1021313C32_) {
                throw new \Exception("Không tìm thấy DNS record với tên: " . $recordName);
            }
            $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $this->client->put("zones/" . $this->zoneId . "/dns_records/" . $_obfuscated_0D08342F1604241E0B090F21210937351D3C1021313C32_, ["json" => ["type" => $recordType, "name" => $recordName, "content" => $recordContent]]);
            return json_decode((string) $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->getBody(), true);
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new \Exception("Lỗi khi gọi API: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        } catch (\Exception $ex) {
            throw new \Exception("Lỗi: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    private function getDnsRecordId($name, $type)
    {
        try {
            $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $this->client->get("zones/" . $this->zoneId . "/dns_records", ["query" => ["name" => $name, "type" => $type]]);
            $data = json_decode((string) $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->getBody(), true);
            if(!empty($data["result"]) && is_array($data["result"])) {
                return $data["result"][0]["id"] ?? NULL;
            }
            return NULL;
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new \Exception("Lỗi khi tìm kiếm DNS record: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    public function listDnsRecords()
    {
        try {
            $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $this->client->get("zones/" . $this->zoneId . "/dns_records", ["query" => ["per_page" => 100]]);
            $data = json_decode((string) $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->getBody(), true);
            if(!isset($data["success"]) || !$data["success"]) {
                throw new \Exception("Failed to fetch DNS records");
            }
            return $data["result"];
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new \Exception("Error while fetching DNS records: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
}

?>