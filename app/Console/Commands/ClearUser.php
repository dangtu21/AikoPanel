<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ClearUser extends \Illuminate\Console\Command
{
    protected $signature = "clear:user";
    protected $description = "Nhiệm vụ xóa người dùng không hoạt động trong 30 ngày";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\User::where(function ($query) {
            $query->where("plan_id", NULL)->where("transfer_enable", 0)->where("expired_at", 0)->where("last_login_at", NULL);
        })->orWhere(function ($query) {
            $query->where("expired_at", "<", now()->subDays(60));
        });
        $count = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->count();
        if($_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->delete()) {
            $this->info("Đã xóa " . $count . " Người dùng không có dữ liệu hoặc đã hết hạn sử dụng quá 60 ngày");
        }
    }
}

?>