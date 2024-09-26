<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class OrderHandleJob implements \Illuminate\Contracts\Queue\ShouldQueue
{
    use \Illuminate\Foundation\Bus\Dispatchable;
    use \Illuminate\Queue\InteractsWithQueue;
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    protected $order;
    public $tries = 3;
    public $timeout = 5;
    public function __construct($tradeNo)
    {
        $this->onQueue("order_handle");
        $this->order = \App\Models\Order::where("trade_no", $tradeNo)->lockForUpdate()->first();
    }
    public function handle()
    {
        if(!$this->order) {
            return NULL;
        }
        $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_ = new \App\Services\OrderService($this->order);
        switch ($this->order->status) {
            case 0:
                if($this->order->created_at <= time() - (int) config("aikopanel.interval_order_time", 120) * 60) {
                    $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->cancel();
                }
                break;
            case 1:
                $_obfuscated_0D230F1D26172B370328241717040203345C0112272D11_->open();
                break;
        }
    }
}

?>