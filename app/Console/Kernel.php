<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console;

class Kernel extends \Illuminate\Foundation\Console\Kernel
{
    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        \Illuminate\Support\Facades\Cache::put(\App\Utils\CacheKey::get("SCHEDULE_LAST_CHECK_AT", NULL), time());
        $this->scheduleDailyTasks($schedule);
        $this->scheduleMinuteTasks($schedule);
        $this->scheduleConditionalTasks($schedule);
        $this->scheduleUserSpecificTasks($schedule);
    }
    private function scheduleDailyTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $schedule->command("aikopanel:statistics")->dailyAt("0:00");
        $schedule->command("reset:traffic")->daily();
        $schedule->command("reset:log")->daily();
        $schedule->command("send:remindMail")->dailyAt("12:00");
        $schedule->command("send:remindTele")->dailyAt("12:00");
        $this->scheduleClearUserTask($schedule);
    }
    private function scheduleMinuteTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $schedule->command("check:order")->everyMinute();
        $schedule->command("check:commission")->everyMinute();
        $schedule->command("check:ticket")->everyMinute();
        $schedule->command("get:AppleID")->everyMinute();
        $schedule->command("horizon:snapshot")->everyFiveMinutes();
        $this->scheduleUpdateDnsTask($schedule);
    }
    private function scheduleConditionalTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        if($_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config("aikopanel.interval_backup_database")) {
            $schedule->command("backup:aikopanel")->cron("0 */" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * *");
        }
        if(config("aikopanel.report_node_online")) {
            $this->scheduleReportNodeOnlineTasks($schedule);
        }
        if(config("aikopanel.report_user_traffic_today")) {
            $this->scheduleReportUserTrafficTasks($schedule);
        }
        if(config("aikopanel.report_node_traffic_today")) {
            $this->scheduleReportNodeTrafficTasks($schedule);
        }
        if($_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config("aikopanel.interval_check_server")) {
            $schedule->command("check:server")->cron("*/" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * * *");
        }
    }
    private function scheduleUserSpecificTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::where("is_staff", 1)->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            $this->scheduleTasksForUser($user, $schedule);
        }
    }
    private function scheduleTasksForUser($user, $schedule)
    {
        if(config("staff.aikopanel-id-" . $user->id . ".telegram_bot_token")) {
            $this->scheduleStaffReportTasks($user, $schedule);
        }
    }
    private function scheduleStaffReportTasks($user, $schedule)
    {
        if(config("staff.aikopanel-id-" . $user->id . ".report_node_online")) {
            $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config("staff.aikopanel-id-" . $user->id . ".interval_report_node_online_to_user_today");
            if(0 < $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_) {
                $schedule->command("report:nodeonline --user " . $user->id)->cron("*/" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * * *");
            }
        }
        if(config("staff.aikopanel-id-" . $user->id . ".report_user_traffic_today")) {
            $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config("staff.aikopanel-id-" . $user->id . ".interval_report_user_traffic_to_user_today");
            if(0 < $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_) {
                $schedule->command("report:usertraffictoday --user " . $user->id)->cron("*/" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * * *");
            }
        }
        if(config("staff.aikopanel-id-" . $user->id . ".report_node_traffic_today")) {
            $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config("staff.aikopanel-id-" . $user->id . ".interval_report_node_traffic_to_user_today");
            if(0 < $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_) {
                $schedule->command("report:nodetraffictoday --user " . $user->id)->cron("*/" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * * *");
            }
        }
    }
    private function scheduleClearUserTask(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        config("aikopanel.interval_clear_user");
        switch (config("aikopanel.interval_clear_user")) {
            case 1:
                $schedule->command("clear:user")->daily();
                break;
            case 2:
                $schedule->command("clear:user")->weekly();
                break;
            case 3:
                $schedule->command("clear:user")->monthly();
                break;
            case 4:
                $schedule->command("clear:user")->yearly();
                break;
        }
    }
    private function scheduleUpdateDnsTask(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        if(config("aikopanel.cloudflare_email") && config("aikopanel.cloudflare_api_key") && config("aikopanel.cloudflare_zone_id")) {
            $schedule->command("update:dns")->everyMinute();
        }
    }
    private function scheduleReportNodeOnlineTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $this->scheduleReportTask($schedule, "report:nodeonline", "aikopanel.interval_report_node_online_to_admin_today", "--admin");
        $this->scheduleReportTask($schedule, "report:nodeonline", "aikopanel.interval_report_node_online_to_user_today", "--user");
    }
    private function scheduleReportUserTrafficTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $this->scheduleReportTask($schedule, "report:usertraffictoday", "aikopanel.interval_report_user_traffic_to_admin_today", "--admin");
        $this->scheduleReportTask($schedule, "report:usertraffictoday", "aikopanel.interval_report_user_traffic_to_user_today", "--user");
    }
    private function scheduleReportNodeTrafficTasks(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        $this->scheduleReportTask($schedule, "report:nodetraffictoday", "aikopanel.interval_report_node_traffic_to_admin_today", "--admin");
        $this->scheduleReportTask($schedule, "report:nodetraffictoday", "aikopanel.interval_report_node_traffic_to_user_today", "--user");
    }
    private function scheduleReportTask($schedule, $command, $configKey, $option)
    {
        $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ = config($configKey);
        if(0 < $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_) {
            $schedule->command($command . " " . $option)->cron("*/" . $_obfuscated_0D332211301C105B3F0636403F3F2A0F0C302C19012C11_ . " * * * *");
        }
    }
    protected function commands()
    {
        $this->load(__DIR__ . "/Commands");
        require base_path("routes/console.php");
    }
}

?>