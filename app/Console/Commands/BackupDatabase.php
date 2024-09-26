<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class BackupDatabase extends \Illuminate\Console\Command
{
    protected $signature = "backup:aikopanel";
    protected $description = "Auto backup info AikoPanel and Send to Telegram";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $this->info("Starting backup...");
        try {
            $_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_ = $this->createDatabaseBackup();
            $_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_ = $this->createZip($_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_);
            $this->sendBackupToTelegram($_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_);
            unlink($_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_);
            unlink($_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_);
        } catch (\Exception $ex) {
            $this->error("Backup failed: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
            return 1;
        }
        $this->info("Backup completed successfully.");
        return 0;
    }
    private function createDatabaseBackup()
    {
        $_obfuscated_0D3D122607041D233F0F2D211E1F150119072606363911_ = config("database.connections.mysql.database");
        $username = config("database.connections.mysql.username");
        $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ = config("database.connections.mysql.password");
        $_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_ = base_path("database/backup/" . config("database.connections.mysql.database") . ".sql");
        $_obfuscated_0D2A25303C2317341A150F5B1F01343D5C08093D360301_ = "mysqldump -u " . $username . " -p'" . $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ . "' " . $_obfuscated_0D3D122607041D233F0F2D211E1F150119072606363911_ . " > '" . $_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_ . "'";
        $_obfuscated_0D2C29153D1C22302B0F3C0D230917162B332519293711_ = \Symfony\Component\Process\Process::fromShellCommandline($_obfuscated_0D2A25303C2317341A150F5B1F01343D5C08093D360301_);
        $_obfuscated_0D2C29153D1C22302B0F3C0D230917162B332519293711_->run();
        if(!$_obfuscated_0D2C29153D1C22302B0F3C0D230917162B332519293711_->isSuccessful()) {
            throw new \Symfony\Component\Process\Exception\ProcessFailedException($_obfuscated_0D2C29153D1C22302B0F3C0D230917162B332519293711_);
        }
        return $_obfuscated_0D1230010D3938312806162C21081D400A0C340B160301_;
    }
    private function createZip($filePath)
    {
        $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_ = new \ZipArchive();
        $_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_ = base_path("database/backup/" . now()->format("H-i_d-m-Y") . "_" . config("database.connections.mysql.database") . ".zip");
        if($_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->open($_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \Exception("Could not create zip file.");
        }
        $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->addFile($filePath, basename($filePath));
        $_obfuscated_0D5B07241B3E2F1325231C032F2E122C19054002281922_ = base_path("config/aikopanel.php");
        if(file_exists($_obfuscated_0D5B07241B3E2F1325231C032F2E122C19054002281922_)) {
            $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->addFile($_obfuscated_0D5B07241B3E2F1325231C032F2E122C19054002281922_, "config/aikopanel.php");
        }
        $_obfuscated_0D1928180913182426090D323238233F2510192D125C22_ = base_path(".env");
        if(file_exists($_obfuscated_0D1928180913182426090D323238233F2510192D125C22_)) {
            $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->addFile($_obfuscated_0D1928180913182426090D323238233F2510192D125C22_, "env");
        }
        $_obfuscated_0D3C1F105B310C36290E2F232B1E092106400734190801_ = base_path("config/staff/*");
        foreach (glob($_obfuscated_0D3C1F105B310C36290E2F232B1E092106400734190801_) as $file) {
            $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->addFile($file, "config/staff/" . basename($file));
        }
        $_obfuscated_0D090D095B263F142D180B1F342C390B361D2E0D2E1001_->close();
        return $_obfuscated_0D36112F3029111C080F342C1C3C3F1B341A2610251801_;
    }
    private function sendBackupToTelegram($filePath)
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        $_obfuscated_0D175C0E2A0C0E36370D34293831023829241509270811_ = \App\Utils\Helper::getIDTelegramBackup();
        $_obfuscated_0D3E0E283610391B141523100E151C0E2915223F051A32_ = false;
        foreach ($_obfuscated_0D175C0E2A0C0E36370D34293831023829241509270811_ as $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_) {
            if(empty($_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_)) {
                $this->info("Skipping empty Telegram Admin ID.");
            } else {
                $_obfuscated_0D081B042D2C0D27081F06380319401D29222C1D1F3C11_ = \App\Models\User::where("telegram_id", $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_)->first();
                if(!$_obfuscated_0D081B042D2C0D27081F06380319401D29222C1D1F3C11_->is_admin == 1) {
                    $this->info("Skipping non-admin ID: " . $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_ . ".");
                } elseif(!$_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendDocument($_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_, $filePath)) {
                    $this->error("Failed to send backup to Telegram for Admin ID: " . $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_);
                } else {
                    $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessage($_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_, "Database backup done! Version: " . config("app.version"));
                    $this->info("Backup sent to Telegram successfully for Admin ID: " . $_obfuscated_0D1005171B09073138282B3319301719120D0A3E1D2501_);
                    $_obfuscated_0D3E0E283610391B141523100E151C0E2915223F051A32_ = true;
                }
            }
        }
        if(!$_obfuscated_0D3E0E283610391B141523100E151C0E2915223F051A32_) {
            $this->info("No valid Telegram Admin ID found. Backup stored locally at: " . $filePath);
        }
    }
}

?>