<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ExportV2Log extends \Illuminate\Console\Command
{
    protected $signature = "log:export {days=1 : The number of days to export logs for}";
    protected $description = "Export v2_log table records of the specified number of days to a file";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D1E15190F1336052A012F5C2E26191F183F3021150C11_ = $this->argument("days");
        $date = \Carbon\Carbon::now()->subDays($_obfuscated_0D1E15190F1336052A012F5C2E26191F183F3021150C11_)->startOfDay();
        $_obfuscated_0D311934261D040421160C082C062D14082717132C2132_ = \DB::table("v2_log")->where("created_at", ">=", $date->timestamp)->get();
        $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_ = "v2_logs_" . \Carbon\Carbon::now()->format("Y_m_d_His") . ".csv";
        $handle = fopen(storage_path("logs/" . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_), "w");
        fputcsv($handle, ["Level", "ID", "Title", "Host", "URI", "Method", "Data", "IP", "Context", "Created At", "Updated At"]);
        foreach ($_obfuscated_0D311934261D040421160C082C062D14082717132C2132_ as $log) {
            fputcsv($handle, [$log->level, $log->id, $log->title, $log->host, $log->uri, $log->method, $log->data, $log->ip, $log->context, \Carbon\Carbon::createFromTimestamp($log->created_at)->toDateTimeString(), \Carbon\Carbon::createFromTimestamp($log->updated_at)->toDateTimeString()]);
        }
        fclose($handle);
        $this->info("Logs exported to " . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_);
    }
}

?>