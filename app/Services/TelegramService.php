<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class TelegramService
{
    protected $api;
    public function __construct($token = "", $id = NULL)
    {
        $tokenKey = "aikopanel.telegram_bot_token";
        if($id !== NULL && config("staff.aikopanel-id-" . $id . ".telegram_bot_token") !== NULL) {
            $tokenKey = "staff.aikopanel-id-" . $id . ".telegram_bot_token";
        }
        $this->api = "https://api.telegram.org/bot" . config($tokenKey, $token) . "/";
    }
    public function sendMessage(int $chatId, $text, $parseMode = "")
    {
        if($parseMode === "markdown") {
            $text = str_replace("_", "\\_", $text);
        }
        $this->request("sendMessage", ["chat_id" => $chatId, "text" => $text, "parse_mode" => $parseMode]);
    }
    public function approveChatJoinRequest(int $chatId, int $userId)
    {
        $this->request("approveChatJoinRequest", ["chat_id" => $chatId, "user_id" => $userId]);
    }
    public function declineChatJoinRequest(int $chatId, int $userId)
    {
        $this->request("declineChatJoinRequest", ["chat_id" => $chatId, "user_id" => $userId]);
    }
    public function getMe()
    {
        return $this->request("getMe");
    }
    public function setWebhook($url)
    {
        return $this->request("setWebhook", ["url" => $url]);
    }
    private function request($method, array $params = [])
    {
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_ = new \Curl\Curl();
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->get($this->api . $method . "?" . http_build_query($params));
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->response;
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->close();
        if(!isset($response->ok)) {
            abort(500, "Yêu cầu không thành công");
        }
        if(!$response->ok) {
            abort(500, "Lỗi từ TG：" . $response->description);
        }
        return $response;
    }
    public function sendMessageWithAdmin($message, $isStaff = false)
    {
        if(!config("aikopanel.telegram_bot_enable", 0)) {
            return NULL;
        }
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::where(function ($query) use($query) {
            $query->where("is_admin", 1);
            if($isStaff) {
                $query->orWhere("is_staff", 1);
            }
        })->where("telegram_id", "!=", NULL)->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            \App\Jobs\SendTelegramJob::dispatch($user->telegram_id, $message);
        }
    }
    public function sendMessageWithStaff($message, $id = "")
    {
        if(!config("staff.aikopanel-id-" . $id . ".telegram_bot_enable", 0)) {
            return NULL;
        }
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::where(function ($query) {
            $query->where("is_staff", 1);
        })->where("telegram_id", "!=", NULL)->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            \App\Jobs\SendTelegramJob::dispatch($user->telegram_id, $message);
        }
    }
    public function sendMessageWithGroup($text, $chatId, $id = NULL, $parseMode = "")
    {
        if($id !== NULL) {
            if(!config("staff.aikopanel-id-" . $id . ".telegram_bot_enable", 0)) {
                return NULL;
            }
        } elseif(!config("aikopanel.telegram_bot_enable", 0)) {
            return NULL;
        }
        $this->sendMessage($chatId, $text, $parseMode);
    }
    public function sendDocument(int $chatId, $documentPath, $caption = "")
    {
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_ = new \Curl\Curl();
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->post($this->api . "sendDocument", ["chat_id" => $chatId, "document" => new \CURLFile($documentPath), "caption" => $caption]);
        $response = $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->response;
        $_obfuscated_0D0E3F381632140636272C120F023B1C2E21322E0C0B22_->close();
        if(!isset($response->ok)) {
            abort(500, "Yêu cầu không thành công");
        }
        if(!$response->ok) {
            abort(500, "Lỗi từ TG：" . $response->description);
        }
        return $response;
    }
    public function isAdmin(int $telegramId)
    {
        $_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ = \App\Models\User::where(function ($query) {
            $query->where("is_admin", 1);
        })->where("telegram_id", "!=", NULL)->get();
        foreach ($_obfuscated_0D07253C0B32041A1901093B2F391631402B2B26190E32_ as $user) {
            if($user->telegram_id === $telegramId) {
                return true;
            }
            return false;
        }
    }
    private function remindTrafficIsWarnValue($u, $d, $transfer_enable)
    {
        $_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_ = $u + $d;
        if(!$_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_) {
            return false;
        }
        if(!$transfer_enable) {
            return false;
        }
        $_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_ = $_obfuscated_0D035B3D223C280B2E04072C211838130426253C1B0C32_ / $transfer_enable * 100;
        if($_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_ < 80) {
            return false;
        }
        if(100 <= $_obfuscated_0D2D311D2F14070B390E1B2630311A3F360A28403B0F01_) {
            return false;
        }
        return true;
    }
    public function remindExpire(\App\Models\User $user)
    {
        if(!($user->expired_at !== NULL && $user->expired_at - 86400 < time() && time() < $user->expired_at)) {
            return NULL;
        }
        $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_ = \App\Models\Plan::find($user->plan_id)->name;
        $_obfuscated_0D332838131B1A161F242237073B183413021030143101_ = $user->username ? " | Username: " . $user->username : "";
        $message = $this->createExpireMessage($user->id, $_obfuscated_0D332838131B1A161F242237073B183413021030143101_, $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_, $user->email, $user->expired_at);
        if($user->telegram_id !== NULL) {
            $this->sendMessage($user->telegram_id, $message);
        }
        if($user->is_staff || $user->is_admin || 0 < $user->invite_user_id) {
            $this->sendInviteUserNotification($user, $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_);
        }
    }
    private function createExpireMessage($userId, $usernamePart, $planName, $email, $expireAt)
    {
        return "⚠️ Thông báo quan trọng dịch vụ bên " . config("aikopanel.app_name") . "\n\n" . "🔹 ID: " . $userId . $usernamePart . "\n" . "🔹 Thông tin gói: " . $planName . "\n" . "🔹 Email: " . $email . "\n\n" . "---------\n" . "❌ Chú ý: Dịch vụ của bạn sẽ hết hạn vào " . date("d-m-Y H:i:s", $expireAt) . ".\n" . "⭕️ Quý khách có thể kiểm tra gia hạn hoặc nâng cấp";
    }
    private function sendInviteUserNotification(\App\Models\User $user, $planName)
    {
        if($user->invite_user_id !== NULL && $user->invite_user_id !== 0) {
            $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ = \App\Models\User::find($user->invite_user_id);
            if($_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_) {
                $message = "⚠️ Thông báo quan trọng dịch vụ bên " . config("aikopanel.app_name") . "\n\n" . "❌ Chú ý: Người dùng có ID " . $user->id . " đã sử dụng gói " . $planName . " hiện tại sắp hết hạn vào " . date("d-m-Y H:i", $user->expired_at) . ".\n\n" . "🔹 Email: " . $user->email . "\n\n" . "---------\n" . "🔹 Email nhân viên: " . $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->email . "\n\n" . "⭕️ Vui lòng xem xét nhắc nhở khách hàng nâng cấp hoặc gia hạn để tránh gián đoạn dịch vụ.";
                $this->sendMessage($_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->telegram_id, $message);
            }
        }
    }
    public function remindTraffic(\App\Models\User $user)
    {
        if(!$this->remindTrafficIsWarnValue($user->u, $user->d, $user->transfer_enable)) {
            return NULL;
        }
        $flag = \App\Utils\CacheKey::get("LAST_SEND_TELE_REMIND_TRAFFIC", $user->id);
        if(\Illuminate\Support\Facades\Cache::get($flag)) {
            return NULL;
        }
        \Illuminate\Support\Facades\Cache::put($flag, 1, 86400);
        $_obfuscated_0D19301B03282C0422131732110E0D363F2A5C2B232132_ = round(($user->u + $user->d) / $user->transfer_enable * 100, 2);
        $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_ = \App\Models\Plan::find($user->plan_id)->name;
        $usernamePart = $user->username ? " | Username: " . $user->username : "";
        $message = "⚠️ Thông báo quan trọng dịch vụ bên " . config("aikopanel.app_name") . "\n\n" . "❌ Chú ý: Bạn đã sử dụng " . $_obfuscated_0D19301B03282C0422131732110E0D363F2A5C2B232132_ . "% lưu lượng của mình.\n\n" . "🔹 ID Người Dùng: " . $user->id . $usernamePart . "\n" . "🔹 Gói: " . $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_ . "\n" . "🔹 Email: " . $user->email . "\n\n" . "⭕️ Để tránh gián đoạn, vui lòng xem xét nâng cấp hoặc quản lý việc sử dụng lưu lượng.";
        if($user->telegram_id !== NULL) {
            $this->sendMessage($user->telegram_id, $message);
        }
        if($user->is_staff || $user->is_admin || 0 < $user->invite_user_id) {
            $this->sendInviteUserTrafficNotification($user, $_obfuscated_0D19301B03282C0422131732110E0D363F2A5C2B232132_, $_obfuscated_0D1F3B130C302633103D065C085C1A2B1E402C232F1A22_);
        }
    }
    private function sendInviteUserTrafficNotification(\App\Models\User $user, $percentUsed, $plan_name)
    {
        if(0 < $user->invite_user_id) {
            $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_ = \App\Models\User::find($user->invite_user_id);
            if($user->id === $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->id) {
                return NULL;
            }
            $usernamePart = $user->username ? " | Username: " . $user->username : "";
            if($_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_) {
                $message = "⚠️ Thông báo quan trọng dịch vụ bên " . config("aikopanel.app_name") . "\n\n" . "❌ Chú ý: Người dùng " . $user->id . " đã sử dụng " . $percentUsed . "% lưu lượng của gói " . $plan_name . ".\n\n" . "🔹 ID: " . $user->id . $usernamePart . "\n" . "🔹 Email: " . $user->email . "\n\n" . "---------\n" . "🔹 Email Nhân viên: " . $_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->email . "\n\n" . "⭕️ Vui lòng xem xét nâng cấp hoặc quản lý việc sử dụng lưu lượng để tránh gián đoạn dịch vụ.";
                $this->sendMessage($_obfuscated_0D32243529071E040F5C340A18263C390D271B165B3132_->telegram_id, $message);
            }
        }
    }
}

?>