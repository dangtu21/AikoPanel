<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class StatUserJob implements \Illuminate\Contracts\Queue\ShouldQueue
{
    use \Illuminate\Foundation\Bus\Dispatchable;
    use \Illuminate\Queue\InteractsWithQueue;
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    protected $data;
    protected $server;
    protected $protocol;
    protected $recordType;
    public $tries = 3;
    public $timeout = 60;
    public function __construct(array $data, array $server, $protocol, $recordType = "d")
    {
        $this->onQueue("stat");
        $this->data = $data;
        $this->server = $server;
        $this->protocol = $protocol;
        $this->recordType = $recordType;
    }
    public function handle()
    {
        $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_ = strtotime(date("d-m-Y"));
        if($this->recordType === "m") {
        }
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            foreach (array_keys($this->data) as $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_) {
                $_obfuscated_0D1907221236013B330304360C095C5C2426070F5C3C01_ = \App\Models\StatUser::where("record_at", $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_)->where("server_rate", $this->server["rate"])->where("user_id", $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_)->lockForUpdate()->first();
                if($_obfuscated_0D1907221236013B330304360C095C5C2426070F5C3C01_) {
                    $_obfuscated_0D1907221236013B330304360C095C5C2426070F5C3C01_->update(["u" => $_obfuscated_0D1907221236013B330304360C095C5C2426070F5C3C01_["u"] + $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][0], "d" => $_obfuscated_0D1907221236013B330304360C095C5C2426070F5C3C01_["d"] + $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][1]]);
                } else {
                    $_obfuscated_0D03050937010A1C105C5B153B1F383C1E402533331D01_[] = ["user_id" => $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_, "server_rate" => $this->server["rate"], "u" => $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][0], "d" => $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][1], "record_type" => $this->recordType, "record_at" => $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_];
                }
            }
            if(!empty($_obfuscated_0D03050937010A1C105C5B153B1F383C1E402533331D01_)) {
                \App\Models\StatUser::upsert($_obfuscated_0D03050937010A1C105C5B153B1F383C1E402533331D01_, ["user_id", "server_rate", "record_at"]);
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, "Thống kê người dùng không thành công" . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
}

?>