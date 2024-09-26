<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class AuthService
{
    private $user;
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }
    public function generateAuthData(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D140909265B03311A07070923292F2514011423382411_ = \App\Utils\Helper::guid();
        $_obfuscated_0D221025113B2433141903275B5B311B240E5C1A264022_ = \Firebase\JWT\JWT::encode(["id" => $this->user->id, "session" => $guid], config("app.key"), "HS256");
        self::addSession($this->user->id, $guid, ["ip" => $request->ip(), "login_at" => time(), "ua" => $request->userAgent()]);
        return ["token" => $this->user->token, "is_admin" => $this->user->is_admin, "is_staff" => $this->user->is_staff, "auth_data" => $_obfuscated_0D221025113B2433141903275B5B311B240E5C1A264022_];
    }
    public static function decryptAuthData($jwt)
    {
        try {
            if(!\Illuminate\Support\Facades\Cache::has($jwt)) {
                $data = (array) \Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key(config("app.key"), "HS256"));
                if(!self::checkSession($data["id"], $data["session"])) {
                    return false;
                }
                $user = \App\Models\User::select(["id", "email", "is_admin", "is_staff"])->find($data["id"]);
                if(!$user) {
                    return false;
                }
                \Illuminate\Support\Facades\Cache::put($jwt, $user->toArray(), 3600);
            }
            return \Illuminate\Support\Facades\Cache::get($jwt);
        } catch (\Exception $ex) {
            return false;
        }
    }
    private static function checkSession($userId, $session)
    {
        $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_ = (array) \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("USER_SESSIONS", $userId)) ?? [];
        if(!in_array($session, array_keys($_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_))) {
            return false;
        }
        return true;
    }
    private static function addSession($userId, $guid, $meta)
    {
        $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = \App\Utils\CacheKey::get("USER_SESSIONS", $userId);
        $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_ = (array) \Illuminate\Support\Facades\Cache::get($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, []);
        $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_[$guid] = $meta;
        $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ = config("aikopanel.session_ttl");
        $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ = isset($_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_) ? $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ * 60 : NULL;
        $user = \App\Models\User::find($userId);
        if($user->is_admin && config("aikopanel.admin_session_ttl")) {
            $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_ = NULL;
        }
        \Illuminate\Support\Facades\Cache::put($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_, $_obfuscated_0D392C403D303E263B383922370D2B33081518023B1B01_);
        return true;
    }
    public function getSessions()
    {
        return (array) \Illuminate\Support\Facades\Cache::get(\App\Utils\CacheKey::get("USER_SESSIONS", $this->user->id), []);
    }
    public function removeSession($sessionId)
    {
        $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = \App\Utils\CacheKey::get("USER_SESSIONS", $this->user->id);
        $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_ = (array) \Illuminate\Support\Facades\Cache::get($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, []);
        unset($_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_[$sessionId]);
        if(!\Illuminate\Support\Facades\Cache::put($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_, $_obfuscated_0D251F14040506135B29133F3C253431191F072E052B11_)) {
            return false;
        }
        return true;
    }
    public function removeAllSession()
    {
        $_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_ = \App\Utils\CacheKey::get("USER_SESSIONS", $this->user->id);
        return \Illuminate\Support\Facades\Cache::forget($_obfuscated_0D362305040F330528103F1E15331F195C25125C0A0D32_);
    }
}

?>