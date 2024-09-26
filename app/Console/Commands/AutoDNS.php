<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AutoDNS extends \Illuminate\Console\Command
{
    protected $signature = "update:dns";
    protected $description = "Update DNS records from Cloudflare";
    private $cloudflareService;
    public function __construct(\App\Services\CloudflareService $cloudflareService)
    {
        parent::__construct();
        $this->cloudflareService = $cloudflareService;
    }
    public function handle()
    {
        $_obfuscated_0D2D2E162610305C23141D3B25102139391D2715041622_ = $this->cloudflareService->listDnsRecords();
        if(empty($_obfuscated_0D2D2E162610305C23141D3B25102139391D2715041622_)) {
            $this->error("No DNS records found.");
            return 0;
        }
        foreach ($_obfuscated_0D2D2E162610305C23141D3B25102139391D2715041622_ as $_obfuscated_0D2E262D19083F2C2C26040734361C383223081B313822_) {
            $this->updateServerRecord($_obfuscated_0D2E262D19083F2C2C26040734361C383223081B313822_);
        }
        $this->info("DNS records have been updated successfully.");
        return 0;
    }
    private function updateServerRecord($record)
    {
        $_obfuscated_0D37262631183F241813052D38081916040C3E2E5B2722_ = ["App\\Models\\ServerTrojan", "App\\Models\\ServerVless", "App\\Models\\ServerVmess", "App\\Models\\ServerShadowsocks", "App\\Models\\ServerHysteria"];
        foreach ($_obfuscated_0D37262631183F241813052D38081916040C3E2E5B2722_ as $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_) {
            $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_ = $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_::where("host", $record["name"])->first();
            if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
                $_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_ = ["ip" => $record["content"]];
                if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->isFillable("record_id")) {
                    $_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_["record_id"] = $record["id"];
                }
                $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_->update($_obfuscated_0D400B2B06020D15351F1F0B3E0A0C0C293E3536210401_);
                $this->info("Updated " . $record["name"] . " for " . $_obfuscated_0D322C372829302D26163D2E2932110322153407022822_);
            }
        }
    }
}

?>