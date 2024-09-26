<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Plugins\Telegram;

abstract class Telegram
{
    public $telegramService;
    protected abstract function handle($message, $match);
    public function __construct()
    {
        $this->telegramService = new \App\Services\TelegramService();
    }
}

?>