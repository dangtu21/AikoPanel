<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Guest;

class TelegramController extends \App\Http\Controllers\Controller
{
    protected $msg;
    protected $commands = [];
    protected $telegramService;
    public function __construct(\Illuminate\Http\Request $request)
    {
        if($request->input("access_token") !== md5(config("aikopanel.telegram_bot_token"))) {
            abort(401);
        }
        $this->telegramService = new \App\Services\TelegramService();
    }
    public function webhook(\Illuminate\Http\Request $request)
    {
        $this->formatMessage($request->input());
        $this->formatChatJoinRequest($request->input());
        $this->handle();
    }
    public function handle()
    {
        if(!$this->msg) {
            return NULL;
        }
        $msg = $this->msg;
        $_obfuscated_0D291D3C161A240128245C0B2C0A2C0D212C0E0A132232_ = explode("@", $msg->command);
        if(count($_obfuscated_0D291D3C161A240128245C0B2C0A2C0D212C0E0A132232_) == 2) {
            $_obfuscated_0D2D01301D2A1008160504250D1B1B2E3F3C21160F2B22_ = $this->getBotName();
            if($_obfuscated_0D291D3C161A240128245C0B2C0A2C0D212C0E0A132232_[1] === $_obfuscated_0D2D01301D2A1008160504250D1B1B2E3F3C21160F2B22_) {
                $msg->command = $_obfuscated_0D291D3C161A240128245C0B2C0A2C0D212C0E0A132232_[0];
            }
        }
        try {
            foreach (glob(base_path("app//Plugins//Telegram//Commands") . "/*.php") as $file) {
                $command = basename($file, ".php");
                $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_ = "\\App\\Plugins\\Telegram\\Commands\\" . $command;
                if(!class_exists($_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_)) {
                } else {
                    $_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_ = new $_obfuscated_0D401E100E15352C351B2F37143F321E235C35045B0122_();
                    if($msg->message_type === "message") {
                        if(!isset($_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->command)) {
                        } elseif($msg->command !== $_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->command) {
                        } else {
                            $_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->handle($msg);
                            return NULL;
                        }
                    } elseif($msg->message_type === "reply_message") {
                        if(!isset($_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->regex)) {
                        } elseif(!preg_match($_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->regex, $msg->reply_text, $_obfuscated_0D0E033D29091A2F123035371D092B23391C17271F1401_)) {
                        } else {
                            $_obfuscated_0D133C400F1E5B33101514255C150A13103606113E0E01_->handle($msg, $_obfuscated_0D0E033D29091A2F123035371D092B23391C17271F1401_);
                            return NULL;
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            $this->telegramService->sendMessage($msg->chat_id, $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    public function getBotName()
    {
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $this->telegramService->getMe();
        return $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->result->username;
    }
    private function formatMessage(array $data)
    {
        if(!isset($data["message"])) {
            return NULL;
        }
        if(!isset($data["message"]["text"])) {
            return NULL;
        }
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_ = new \StdClass();
        $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_ = explode(" ", $data["message"]["text"]);
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->command = $_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_[0];
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->args = array_slice($_obfuscated_0D173D101F0B0B3426172C1B032D25180B3D22191B0222_, 1);
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->chat_id = $data["message"]["chat"]["id"];
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->message_id = $data["message"]["message_id"];
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->message_type = "message";
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->text = $data["message"]["text"];
        $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->is_private = $data["message"]["chat"]["type"] === "private";
        if(isset($data["message"]["reply_to_message"]["text"])) {
            $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->message_type = "reply_message";
            $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_->reply_text = $data["message"]["reply_to_message"]["text"];
        }
        $this->msg = $_obfuscated_0D1E12290B253C1E2401243727350E125C0B2A18061322_;
    }
    private function formatChatJoinRequest(array $data)
    {
        if(!isset($data["chat_join_request"])) {
            return NULL;
        }
        if(!isset($data["chat_join_request"]["from"]["id"])) {
            return NULL;
        }
        if(!isset($data["chat_join_request"]["chat"]["id"])) {
            return NULL;
        }
        $user = \App\Models\User::where("telegram_id", $data["chat_join_request"]["from"]["id"])->first();
        if(!$user) {
            $this->telegramService->declineChatJoinRequest($data["chat_join_request"]["chat"]["id"], $data["chat_join_request"]["from"]["id"]);
        } else {
            $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
            if(!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user)) {
                $this->telegramService->declineChatJoinRequest($data["chat_join_request"]["chat"]["id"], $data["chat_join_request"]["from"]["id"]);
            } else {
                $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
                $this->telegramService->approveChatJoinRequest($data["chat_join_request"]["chat"]["id"], $data["chat_join_request"]["from"]["id"]);
            }
        }
    }
}

?>