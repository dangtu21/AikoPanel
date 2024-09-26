<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class UserService
{
    private function calcResetDayByMonthFirstDay()
    {
        $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ = date("d");
        $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ = date("d", strtotime("last day of +0 months"));
        return $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ - $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_;
    }
    private function calcResetDayByExpireDay(int $expiredAt)
    {
        $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_ = date("d", $expiredAt);
        $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ = date("d");
        $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ = date("d", strtotime("last day of +0 months"));
        if((int) $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ <= (int) $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_ && (int) $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ <= (int) $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_) {
            return $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ - $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_;
        }
        if((int) $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ <= (int) $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_) {
            return $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_ - $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_;
        }
        return $_obfuscated_0D2733282A042F140C5B17391727241816153B16403832_ - $_obfuscated_0D350D1F0228390C2A143F061E115B275C2E3E291A3122_ + $_obfuscated_0D311140283C0802271433323B0F3F13385C2823211122_;
    }
    private function calcResetDayByYearFirstDay() : int
    {
        $_obfuscated_0D3E272616251618372F022B341E1226062A3540170201_ = strtotime(date("01-01-Y", strtotime("+1 year")));
        return (int) (($_obfuscated_0D3E272616251618372F022B341E1226062A3540170201_ - time()) / 86400);
    }
    private function calcResetDayByYearExpiredAt($expiredAt)
    {
        $_obfuscated_0D2E320832403E1022251A03353334400C2E3D2C073801_ = date("d-m", $expiredAt);
        $_obfuscated_0D1027405C261B0E2537161E01260B16262E01242F3501_ = strtotime(date($_obfuscated_0D2E320832403E1022251A03353334400C2E3D2C073801_ . "-Y"));
        $_obfuscated_0D3E272616251618372F022B341E1226062A3540170201_ = strtotime("+1 year", $_obfuscated_0D1027405C261B0E2537161E01260B16262E01242F3501_);
        if(time() < $_obfuscated_0D1027405C261B0E2537161E01260B16262E01242F3501_) {
            return (int) (($_obfuscated_0D1027405C261B0E2537161E01260B16262E01242F3501_ - time()) / 86400);
        }
        return (int) (($_obfuscated_0D3E272616251618372F022B341E1226062A3540170201_ - time()) / 86400);
    }
    public function getResetDay(\App\Models\User $user)
    {
        if(!isset($user->plan)) {
            $user->plan = \App\Models\Plan::find($user->plan_id);
        }
        if($user->expired_at <= time() || $user->expired_at === NULL) {
            return NULL;
        }
        if($user->plan->reset_traffic_method === 2) {
            return NULL;
        }
        if($user->plan->reset_traffic_method === NULL) {
            if($user->plan->reset_traffic_method === 0) {
                if($user->plan->reset_traffic_method === 1) {
                    if($user->plan->reset_traffic_method === 2) {
                        if($user->plan->reset_traffic_method === 3) {
                            if($user->plan->reset_traffic_method === 4) {
                                if($user->plan->reset_traffic_method === 5) {
                                } else {
                                    return 1;
                                }
                            } else {
                                return $this->calcResetDayByYearExpiredAt($user->expired_at);
                            }
                        } else {
                            return $this->calcResetDayByYearFirstDay();
                        }
                    } else {
                        return NULL;
                    }
                } else {
                    return $this->calcResetDayByExpireDay($user->expired_at);
                }
            } else {
                return $this->calcResetDayByMonthFirstDay();
            }
        } else {
            $_obfuscated_0D013C401D0436193B0C2C082B271417225C1E1C231322_ = config("aikopanel.reset_traffic_method", 0);
            switch ((int) $_obfuscated_0D013C401D0436193B0C2C082B271417225C1E1C231322_) {
                case 0:
                    return $this->calcResetDayByMonthFirstDay();
                    break;
                case 1:
                    return $this->calcResetDayByExpireDay($user->expired_at);
                    break;
                case 2:
                case 3:
                    return $this->calcResetDayByYearFirstDay();
                    break;
                case 4:
                    return $this->calcResetDayByYearExpiredAt($user->expired_at);
                    break;
                case 5:
                    return 1;
                    break;
            }
        }
    }
    public function isAvailable(\App\Models\User $user)
    {
        if(!$user->banned && $user->transfer_enable && (time() < $user->expired_at || $user->expired_at === NULL)) {
            return true;
        }
        return false;
    }
    public function getAvailableUsers()
    {
        return \App\Models\User::whereRaw("u + d < transfer_enable")->where(function ($query) {
            $query->where("expired_at", ">=", time())->orWhere("expired_at", NULL);
        })->where("banned", 0)->get();
    }
    public function getUnAvailbaleUsers()
    {
        return \App\Models\User::where(function ($query) {
            $query->where("expired_at", "<", time())->orWhere("expired_at", 0);
        })->where(function ($query) {
            $query->where("plan_id", NULL)->orWhere("transfer_enable", 0);
        })->get();
    }
    public function getUsersByIds($ids)
    {
        return \App\Models\User::whereIn("id", $ids)->get();
    }
    public function getAllUsers()
    {
        return \App\Models\User::all();
    }
    public function addBalance($userId, int $balance)
    {
        $user = \App\Models\User::lockForUpdate()->find($userId);
        if(!$user) {
            return false;
        }
        $user->balance = $user->balance + $balance;
        if($user->balance < 0) {
            return false;
        }
        if(!$user->save()) {
            return false;
        }
        return true;
    }
    public function isNotCompleteOrderByUserId($userId)
    {
        $_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_ = \App\Models\Order::whereIn("status", [0, 1])->where("user_id", $userId)->first();
        if(!$_obfuscated_0D210A372B40120E210A0C400F5C1C3D1A360B40083101_) {
            return false;
        }
        return true;
    }
    public function trafficFetch(array $server, $protocol, array $data)
    {
        \App\Jobs\TrafficFetchJob::dispatch($data, $server, $protocol);
        \App\Jobs\StatUserJob::dispatch($data, $server, $protocol, "d");
        \App\Jobs\StatServerJob::dispatch($data, $server, $protocol, "d");
    }
}

?>