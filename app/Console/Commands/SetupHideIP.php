<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class SetupHideIP extends \Illuminate\Console\Command
{
    protected $signature = "system:setup-hideip";
    protected $description = "Install hideip and configure with Cloudflare IPs.";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $this->info("Checking operating system...");
        if(file_exists("/etc/centos-release") || file_exists("/etc/redhat-release")) {
            $_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ = "CentOS";
        } elseif(file_exists("/etc/lsb-release")) {
            $_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ = "Ubuntu";
        } elseif(file_exists("/etc/debian_version")) {
            $_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ = "Debian";
        } else {
            $this->error("Unsupported OS. This script supports Ubuntu, Debian, and CentOS.");
            return NULL;
        }
        $this->info($_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ . " detected.");
        if($_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ === "Ubuntu" || $_obfuscated_0D23160E1C212D0A362E02050608325B101E362A101922_ === "Debian") {
            $_obfuscated_0D330A2505073E22343B310501130B2B2C3311373D1722_ = "apt-get update && apt-get install -y ufw";
        } else {
            $_obfuscated_0D310A2D2D3B32042C263D0E060A232B17211A03393B32_ = "yum install -y epel-release";
            $_obfuscated_0D330A2505073E22343B310501130B2B2C3311373D1722_ = "yum install -y ufw";
            $_obfuscated_0D222B2333152A083F0E1D23273C2F0F2E1D351C1C0322_ = "systemctl stop firewalld && systemctl disable firewalld";
            $this->info("Disabling the default CentOS firewall (firewalld)...");
            exec($_obfuscated_0D222B2333152A083F0E1D23273C2F0F2E1D351C1C0322_, $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
            if($_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_ !== 0) {
                $this->error("Failed to disable firewalld.");
                return NULL;
            }
        }
        $this->info("Preparing to install Hide...");
        if(isset($_obfuscated_0D310A2D2D3B32042C263D0E060A232B17211A03393B32_) && !empty($_obfuscated_0D310A2D2D3B32042C263D0E060A232B17211A03393B32_)) {
            exec($_obfuscated_0D310A2D2D3B32042C263D0E060A232B17211A03393B32_, $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
            if($_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_ !== 0) {
                $this->error("Failed to execute pre-installation command.");
                return NULL;
            }
        }
        $this->info("Installing Hide...");
        exec($_obfuscated_0D330A2505073E22343B310501130B2B2C3311373D1722_, $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        if($_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_ === 0) {
            $this->info("Hide installed successfully.");
        } else {
            $this->error("Failed to install Hide. Please check the installation commands and try again.");
        }
        exec("ufw --force reset", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        exec("ufw default deny incoming", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        exec("ufw default allow outgoing", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        exec("ufw allow ssh", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        $_obfuscated_0D3B011E1332122D142D28193C3025375B2C12235C2401_ = sys_get_temp_dir() . "/cloudflare-ufw.sh";
        exec("curl -s https://raw.githubusercontent.com/Github-Aiko/cloudflare-ufw/master/cloudflare-ufw.sh -o " . escapeshellarg($_obfuscated_0D3B011E1332122D142D28193C3025375B2C12235C2401_));
        exec("bash " . escapeshellarg($_obfuscated_0D3B011E1332122D142D28193C3025375B2C12235C2401_), $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
        if($_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_ === 0) {
            $this->info("Hide configured with Cloudflare IPs successfully.");
            @unlink($_obfuscated_0D3B011E1332122D142D28193C3025375B2C12235C2401_);
            exec("ufw --force enable", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
            exec("ufw reload", $_obfuscated_0D0C31223C05281416262E022D393739210402343B0211_, $_obfuscated_0D24161D333B0D0C071B2B34321D243C21021B08161932_);
            $this->info("Hide configuration completed.");
        } else {
            $this->error("Failed to configure Hide with Cloudflare IPs.");
        }
    }
}

?>