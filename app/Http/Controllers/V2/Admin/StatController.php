<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V2\Admin;

class StatController extends \App\Http\Controllers\Controller
{
    public function override(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = $request->validate(["start_at" => "", "end_at" => ""]);
        if(isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["start_at"]) && isset($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["end_at"])) {
            $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = \App\Models\Stat::where("record_at", ">=", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["start_at"])->where("record_at", "<", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["end_at"])->get()->makeHidden(["record_at", "created_at", "updated_at", "id", "record_type"])->toArray();
            $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_ = array_reduce($_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_, function ($carry, $item) {
                foreach ($item as $key => $value) {
                    if(isset($carry[$key]) && $carry[$key]) {
                        $carry >>= $key;
                    } else {
                        $carry[$key] = $value;
                    }
                }
                return $carry;
            }, []);
            return ["data" => $_obfuscated_0D18170F042707261F0640381519181C2C023B26083122_];
        }
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_ = new \App\Services\StatisticalService();
        return ["data" => $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->generateStatData()];
    }
    public function record(\Illuminate\Http\Request $request)
    {
        $request->validate(["type" => "required|in:paid_total,commission_total,register_count", "start_at" => "", "end_at" => ""]);
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_ = new \App\Services\StatisticalService();
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setStartAt($request->input("start_at"));
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setEndAt($request->input("end_at"));
        return ["data" => $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->getStatRecord($request->input("type"))];
    }
    public function ranking(\Illuminate\Http\Request $request)
    {
        $request->validate(["type" => "required|in:server_traffic_rank,user_consumption_rank,invite_rank", "start_at" => "", "end_at" => "", "limit" => "nullable|integer"]);
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_ = new \App\Services\StatisticalService();
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setStartAt($request->input("start_at"));
        $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->setEndAt($request->input("end_at"));
        return ["data" => $_obfuscated_0D0333032E15071D261F3E2B1204381F1828252E113722_->getRanking($request->input("type"), $request->input("limit") ?? 20)];
    }
}

?>