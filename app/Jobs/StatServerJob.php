<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class StatServerJob implements \Illuminate\Contracts\Queue\ShouldQueue
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
            $_obfuscated_0D3B322416311E19352E29273211301030351F1E5C1B22_ = 0;
            $d = 0;
            foreach (array_keys($this->data) as $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_) {
                $_obfuscated_0D3B322416311E19352E29273211301030351F1E5C1B22_ .= $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][0];
                $d .= $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][1];
            }
            $_obfuscated_0D153F361B313716220F182E3B34172E3F1C10390A2211_ = \App\Models\StatServer::lockForUpdate()->where("record_at", $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_)->where("server_id", $this->server["id"])->where("server_type", $this->protocol)->lockForUpdate()->first();
            if($_obfuscated_0D153F361B313716220F182E3B34172E3F1C10390A2211_) {
                $_obfuscated_0D153F361B313716220F182E3B34172E3F1C10390A2211_->update(["u" => $_obfuscated_0D153F361B313716220F182E3B34172E3F1C10390A2211_["u"] + $_obfuscated_0D3B322416311E19352E29273211301030351F1E5C1B22_, "d" => $_obfuscated_0D153F361B313716220F182E3B34172E3F1C10390A2211_["d"] + $d]);
            } else {
                \App\Models\StatServer::create(["server_id" => $this->server["id"], "server_type" => $this->protocol, "u" => $_obfuscated_0D3B322416311E19352E29273211301030351F1E5C1B22_, "d" => $d, "record_type" => $this->recordType, "record_at" => $_obfuscated_0D041E07233D2118152B032A301A10340E252E10060E01_]);
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, "Thống kê nút không thành công" . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
}

?>