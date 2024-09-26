<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class SendTelegramJob implements \Illuminate\Contracts\Queue\ShouldQueue
{
    use \Illuminate\Foundation\Bus\Dispatchable;
    use \Illuminate\Queue\InteractsWithQueue;
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    protected $telegramId;
    protected $text;
    public $tries = 3;
    public $timeout = 10;
    public function __construct(int $telegramId, $text)
    {
        $this->onQueue("send_telegram");
        $this->telegramId = $telegramId;
        $this->text = $text;
    }
    public function handle()
    {
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_ = new \App\Services\TelegramService();
        $_obfuscated_0D3B39321F11052A3B3B40051C2E032A032A193D252E11_->sendMessage($this->telegramId, $this->text, "markdown");
    }
}

?>