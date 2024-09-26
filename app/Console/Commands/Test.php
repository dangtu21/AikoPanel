<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class Test extends \Illuminate\Console\Command
{
    protected $signature = "aikopanel:test";
    protected $description = "";
    protected $licenseService;
    public function __construct(\App\Services\LicenseService $licenseService)
    {
        parent::__construct();
        $this->licenseService = $licenseService;
    }
    public function handle()
    {
        $url = parse_url(config("aikopanel.app_url", "aikopanel.com"), PHP_URL_HOST);
        if(!$this->licenseService->isLicenseValidWithDomain($url)) {
            $this->error("License không hợp lệ. Không thể thực hiện chức năng.");
        } else {
            $this->info("License hợp lệ. Thực hiện chức năng...");
        }
    }
}

?>