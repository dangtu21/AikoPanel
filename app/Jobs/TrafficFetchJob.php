<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class TrafficFetchJob implements \Illuminate\Contracts\Queue\ShouldQueue
{
    use \Illuminate\Foundation\Bus\Dispatchable;
    use \Illuminate\Queue\InteractsWithQueue;
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    protected $data;
    protected $server;
    protected $protocol;
    public $tries = 3;
    public $timeout = 10;
    public function __construct(array $data, array $server, $protocol)
    {
        $this->onQueue("traffic_fetch");
        $this->data = $data;
        $this->server = $server;
        $this->protocol = $protocol;
    }
    public function handle()
    {
        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            foreach (array_keys($this->data) as $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_) {
                $user = \App\Models\User::lockForUpdate()->find($_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_);
                if(!$user) {
                } else {
                    $user->t = time();
                    $user->u = $user->u + $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][0] * $this->server["rate"];
                    $user->d = $user->d + $this->data[$_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_][1] * $this->server["rate"];
                    if(!$user->save()) {
                        info("Cập nhật lưu lượng thất bại\nID người dùng chưa được ghi nhận: " . $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ . "\nUpstream chưa được ghi nhận: " . $user->u . "\nDownstream chưa được ghi nhận: " . $user->d);
                    }
                }
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\DB::rollback();
            abort(500, "Cập nhật lưu lượng người dùng không thành công" . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
}

?>