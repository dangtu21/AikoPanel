<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class CheckTicket extends \Illuminate\Console\Command
{
    protected $signature = "check:ticket";
    protected $description = "Nhiệm vụ kiểm tra vé hỗ trợ";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        ini_set("memory_limit", -1);
        $_obfuscated_0D382F023F05041B233240061F0A260437371B3D2B5C01_ = \App\Models\Ticket::where("status", 0)->where("updated_at", "<=", time() - 86400)->where("reply_status", 0)->get();
        foreach ($_obfuscated_0D382F023F05041B233240061F0A260437371B3D2B5C01_ as $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_) {
            if($_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->user_id === $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->last_reply_user_id) {
            } else {
                $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->status = 1;
                $_obfuscated_0D3608225B2B3F27341C2C5B182D3636032E1D2F382A01_->save();
            }
        }
    }
}

?>