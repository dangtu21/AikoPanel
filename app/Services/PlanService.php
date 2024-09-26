<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class PlanService
{
    public $plan;
    public function __construct(int $planId)
    {
        $this->plan = \App\Models\Plan::lockForUpdate()->find($planId);
    }
    public function haveCapacity()
    {
        if($this->plan->capacity_limit === NULL) {
            return true;
        }
        $count = self::countActiveUsers();
        $count = $count[$this->plan->id]["count"] ?? 0;
        return 0 < $this->plan->capacity_limit - $count;
    }
    public static function countActiveUsers()
    {
        return \App\Models\User::select(\Illuminate\Support\Facades\DB::raw("plan_id"), \Illuminate\Support\Facades\DB::raw("count(*) as count"))->where("plan_id", "!=", NULL)->where(function ($query) {
            $query->where("expired_at", ">=", time())->orWhere("expired_at", NULL);
        })->groupBy("plan_id")->get()->keyBy("plan_id");
    }
}

?>