<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class SystemController extends \App\Http\Controllers\Controller
{
    public function getSystemStatus()
    {
        return response(["data" => ["schedule" => $this->getScheduleStatus(), "horizon" => $this->getHorizonStatus(), "schedule_last_runtime" => \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SCHEDULE_LAST_CHECK_AT", NULL))]]);
    }
    public function getQueueWorkload(\Laravel\Horizon\Contracts\WorkloadRepository $workload)
    {
        return response(["data" => collect($workload->get())->sortBy("name")->values()->toArray()]);
    }
    protected function getScheduleStatus()
    {
        return time() - 120 < \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("SCHEDULE_LAST_CHECK_AT", NULL));
    }
    protected function getHorizonStatus()
    {
        if(!($_obfuscated_0D1E271E29082D14011E34232B1F23310D0F1A37373001_ = app("Laravel\\Horizon\\Contracts\\MasterSupervisorRepository")->all())) {
            return false;
        }
        return collect($_obfuscated_0D1E271E29082D14011E34232B1F23310D0F1A37373001_)->contains(function ($master) {
            return $master->status === "paused";
        }) ? false : true;
    }
    public function getQueueStats()
    {
        return response(["data" => ["failedJobs" => app("Laravel\\Horizon\\Contracts\\JobRepository")->countRecentlyFailed(), "jobsPerMinute" => app("Laravel\\Horizon\\Contracts\\MetricsRepository")->jobsProcessedPerMinute(), "pausedMasters" => $this->totalPausedMasters(), "periods" => ["failedJobs" => config("horizon.trim.recent_failed", config("horizon.trim.failed")), "recentJobs" => config("horizon.trim.recent")], "processes" => $this->totalProcessCount(), "queueWithMaxRuntime" => app("Laravel\\Horizon\\Contracts\\MetricsRepository")->queueWithMaximumRuntime(), "queueWithMaxThroughput" => app("Laravel\\Horizon\\Contracts\\MetricsRepository")->queueWithMaximumThroughput(), "recentJobs" => app("Laravel\\Horizon\\Contracts\\JobRepository")->countRecent(), "status" => $this->getHorizonStatus(), "wait" => collect(app("Laravel\\Horizon\\WaitTimeCalculator")->calculate())->take(1)]]);
    }
    protected function totalProcessCount()
    {
        $_obfuscated_0D102F5B091D3C123D055B2B3F0D33082B3E0C061C0F01_ = app("Laravel\\Horizon\\Contracts\\SupervisorRepository")->all();
        return collect($_obfuscated_0D102F5B091D3C123D055B2B3F0D33082B3E0C061C0F01_)->reduce(function ($carry, $supervisor) {
            return $carry + collect($supervisor->processes)->sum();
        }, 0);
    }
    protected function totalPausedMasters()
    {
        if(!($_obfuscated_0D1E271E29082D14011E34232B1F23310D0F1A37373001_ = app("Laravel\\Horizon\\Contracts\\MasterSupervisorRepository")->all())) {
            return 0;
        }
        return collect($_obfuscated_0D1E271E29082D14011E34232B1F23310D0F1A37373001_)->filter(function ($master) {
            return $master->status === "paused";
        })->count();
    }
    public function getSystemLog(\Illuminate\Http\Request $request)
    {
        $current = $request->input("current") ? $request->input("current") : 1;
        $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_ = 10 <= $request->input("page_size") ? $request->input("page_size") : 10;
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\Log::orderBy("created_at", "DESC")->setFilterAllowKeys("level");
        $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->count();
        $res = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->forPage($current, $_obfuscated_0D24092A26152A0424403E012D1211352B0E34031A3B32_)->get();
        return response(["data" => $res, "total" => $_obfuscated_0D2D2F371314041415152B05330140230726170B0D0911_]);
    }
}

?>