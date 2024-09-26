<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Jobs;

class SendEmailJob implements \Illuminate\Contracts\Queue\ShouldQueue
{
    use \Illuminate\Foundation\Bus\Dispatchable;
    use \Illuminate\Queue\InteractsWithQueue;
    use \Illuminate\Bus\Queueable;
    use \Illuminate\Queue\SerializesModels;
    protected $params;
    public $tries = 3;
    public $timeout = 10;
    public function __construct($params, $queue = "send_email")
    {
        $this->onQueue($queue);
        $this->params = $params;
    }
    public function handle()
    {
        if(config("aikopanel.email_host")) {
            \Illuminate\Support\Facades\Config::set("mail.host", config("aikopanel.email_host", env("mail.host")));
            \Illuminate\Support\Facades\Config::set("mail.port", config("aikopanel.email_port", env("mail.port")));
            \Illuminate\Support\Facades\Config::set("mail.encryption", config("aikopanel.email_encryption", env("mail.encryption")));
            \Illuminate\Support\Facades\Config::set("mail.username", config("aikopanel.email_username", env("mail.username")));
            \Illuminate\Support\Facades\Config::set("mail.password", config("aikopanel.email_password", env("mail.password")));
            \Illuminate\Support\Facades\Config::set("mail.from.address", config("aikopanel.email_from_address", env("mail.from.address")));
            \Illuminate\Support\Facades\Config::set("mail.email_payments_success", config("aikopanel.email_payments_success", 0));
            \Illuminate\Support\Facades\Config::set("mail.from.name", config("aikopanel.app_name", "AikoPanel"));
        }
        $params = $this->params;
        $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_ = $params["email"];
        $_obfuscated_0D3312152A2B381B3728193E260B110216120906321C32_ = $params["subject"];
        $params["template_name"] = "mail." . config("aikopanel.email_template", "default") . "." . $params["template_name"];
        try {
            \Illuminate\Support\Facades\Mail::send($params["template_name"], $params["template_value"], function ($message) use($message) {
                $message->to($email)->subject($subject);
            });
        } catch (\Exception $ex) {
            $_obfuscated_0D18361A1925023804082B221F2C032A24011E27372811_ = $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage();
        }
        $log = ["email" => $params["email"], "subject" => $params["subject"], "template_name" => $params["template_name"], "error" => isset($_obfuscated_0D18361A1925023804082B221F2C032A24011E27372811_) ? $_obfuscated_0D18361A1925023804082B221F2C032A24011E27372811_ : NULL];
        \App\Models\MailLog::create($log);
        $log["config"] = config("mail");
        return $log;
    }
}

?>