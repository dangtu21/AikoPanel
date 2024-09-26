<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AikoPanelUpdate extends \Illuminate\Console\Command
{
    protected $signature = "aikopanel:update";
    protected $description = "Update aikopanel";
    protected $licenseService;
    public function __construct(\App\Services\LicenseService $licenseService)
    {
        parent::__construct();
        $this->licenseService = $licenseService;
    }
    public function handle()
    {
        $ip = \App\Utils\Helper::getIp();
        $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ = $this->licenseService->getCurrentDomain();
        $this->info("Giấy phép hợp lệ, bắt đầu cập nhật phiên bản mới nhất...");
        $this->info("Đang cập nhật phiên bản mới nhất...");
        \Artisan::call("config:cache");
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $this->info("Vui lòng đợi cơ sở dữ liệu được nhập vào cơ sở dữ liệu...");
        \Artisan::call("migrate");
        $this->info(\Artisan::output());
        \Artisan::call("horizon:terminate");
        $this->info("Sau khi cập nhật, dịch vụ hàng đợi đã được khởi động lại và bạn không cần thực hiện bất kỳ hoạt động nào.");
        $this->info("Cập nhật thành công, Phiên bản hiện tại: " . config("app.version"));
        if($_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ == "aikopanel.com" || $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ == "v3.aikopanel.com") {
            return NULL;
        }
        if(strpos(config("app.version"), "DEV") !== false) {
            \App\Utils\Helper::notifyViaTelegram("🌎Domain: " . $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ . "\n- IP: " . $ip . "\n- Đã bú DEV");
        } else {
            \App\Utils\Helper::notifyViaTelegram("🌎Domain: " . $_obfuscated_0D2E063E080C1602231C221E2712101E1A3234101D3222_ . "\n- IP: " . $ip . "\n- Đã cập nhật lên phiên bản mới nhất");
        }
    }
}

?>