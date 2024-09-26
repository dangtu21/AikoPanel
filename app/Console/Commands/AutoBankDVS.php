<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AutoBankDVS extends \Illuminate\Console\Command
{
    protected $signature = "update:dvs_bank_auto";
    protected $description = "Auto update DVS bank";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        if(!file_exists(public_path("payments"))) {
            exec("git clone https://github.com/dvsteam/AutoBank-VPN.git " . public_path("payments"));
            if(file_exists(base_path("config/v2board.php"))) {
                $domain = parse_url(config("v2board.app_url", "aikopanel.com"), PHP_URL_HOST);
            } else {
                $domain = parse_url(config("aikopanel.app_url", "aikopanel.com"), PHP_URL_HOST);
            }
            $_obfuscated_0D32322A1311081D3838190A1D2A390A213917123C3932_ = "<?php\nconst CONFIG = [\n    'DOMAIN_WEB' => \"" . $domain . "\", // Your website domain\n\n" . "    'DATABASE' => [ // Check .env file of the web source for DB user, DB password\n" . "        'HOST' => \"" . env("DB_HOST", "localhost") . "\", // Default is localhost (no need to edit)\n" . "        'DBNAME' => \"" . env("DB_DATABASE", "aikopanel") . "\", // DB_DATABASE in .env file\n" . "        'USERNAME' => \"" . env("DB_USERNAME", "aikopanel") . "\", // DB_USERNAME in .env file\n" . "        'PASSWORD' => \"" . env("DB_PASSWORD", "aikopanel") . "\", // DB_PASSWORD in .env file\n" . "    ]\n" . "];";
            file_put_contents(public_path("payments") . "/config.php", $_obfuscated_0D32322A1311081D3838190A1D2A390A213917123C3932_);
            if(!file_exists(public_path("payments"))) {
                $this->error("The specified source directory does not exist.");
                return 1;
            }
            $_obfuscated_0D5C2D1A0712232A1C0B062F37293D1537282E36292911_ = base_path("app/Payments");
            if(!file_exists($_obfuscated_0D5C2D1A0712232A1C0B062F37293D1537282E36292911_) && !mkdir($_obfuscated_0D5C2D1A0712232A1C0B062F37293D1537282E36292911_, 493, true) && !is_dir($_obfuscated_0D5C2D1A0712232A1C0B062F37293D1537282E36292911_)) {
                $this->error("Failed to create the destination directory.");
                return 1;
            }
            $_obfuscated_0D34012E370B24221B04300110150524102B26143B0422_ = "cp -r " . public_path("payments/app/Payments/") . " " . $_obfuscated_0D5C2D1A0712232A1C0B062F37293D1537282E36292911_;
            exec($_obfuscated_0D34012E370B24221B04300110150524102B26143B0422_, $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D06280126283216273521162B353D183C3236071C1422_);
            if($_obfuscated_0D06280126283216273521162B353D183C3236071C1422_ !== 0) {
                $this->error("Failed to copy files.");
                return 1;
            }
        }
        exec("cd " . public_path("payments") . " && git pull");
        $this->info("DVS bank has been updated successfully");
        return 0;
    }
}

?>