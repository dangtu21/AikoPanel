<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\User;

class KnowledgeController extends \App\Http\Controllers\Controller
{
    public function fetch(\Illuminate\Http\Request $request)
    {
        $url = $request->server("HTTP_HOST");
        $_obfuscated_0D290C020B360E1F1F2D223F3715162C123C3B0D3C1D22_ = strval(\App\Models\User::where("staff_url", $url)->first()->id ?? 0);
        if($request->input("id")) {
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_ = \App\Models\Knowledge::where("id", $request->input("id"))->where("show", 1)->first()->toArray();
            if(!$_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_) {
                abort(500, __("Article does not exist"));
            }
            $user = \App\Models\User::find($request->user["id"]);
            $_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_ = new \App\Services\UserService();
            if(!$_obfuscated_0D1D0B0E3D2D123B07351D03052C1D11302524253D2232_->isAvailable($user)) {
                $this->formatAccessData($_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            }
            $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_ = \App\Utils\Helper::getSubscribeUrl("/api/v1/client/subscribe?token=" . $user["token"]);
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"] = str_replace("{{siteName}}", config("aikopanel.app_name", "AikoPanel"), $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"] = str_replace("{{subscribeUrl}}", $_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_, $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"] = str_replace("{{urlEncodeSubscribeUrl}}", urlencode($_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_), $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"] = str_replace("{{safeBase64SubscribeUrl}}", str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($_obfuscated_0D0A2B11182C18220138390232173C1A24372F38272611_)), $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            $this->apple($_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_["body"]);
            return response(["data" => $_obfuscated_0D0A3817112723273F03315C0821070103102F2E263411_]);
        }
        $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = \App\Models\Knowledge::select(["id", "category", "title", "updated_at"])->where("language", $request->input("language"))->where("show", 1)->where(function ($query) use($query) {
            $query->where(function ($subQuery) use($subQuery) {
                $subQuery->whereJsonContains("staff_urls", $userId)->orWhereNull("staff_urls");
            })->orWhereRaw("JSON_LENGTH(staff_urls) = 0")->orWhereRaw("staff_urls IS NULL");
        })->orderBy("sort", "ASC");
        $_obfuscated_0D1F39405B1B2E225B08172D1931190A27091019293511_ = $request->input("keyword");
        if($_obfuscated_0D1F39405B1B2E225B08172D1931190A27091019293511_) {
            $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->where(function ($query) use($query) {
                $query->where("title", "LIKE", "%" . $keyword . "%")->orWhere("body", "LIKE", "%" . $keyword . "%");
            });
        }
        $_obfuscated_0D1D283005122D110C082B1C2A14300F04192217150C32_ = $_obfuscated_0D113518331F1E0D3309383D05320E131F251F25111022_->get()->groupBy("category");
        return response(["data" => $_obfuscated_0D1D283005122D110C082B1C2A14300F04192217150C32_]);
    }
    private function formatAccessData(&$body)
    {
        function getBetween($input, $start, $end)
        {
            $substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end)) * -1);
            return $start . $substr . $end;
        }
        while (strpos($body, "<!--access start-->") !== false) {
            $_obfuscated_0D3626291F0A240D3825292C0929281C07271218174011_ = getBetween($body, "<!--access start-->", "<!--access end-->");
            if($_obfuscated_0D3626291F0A240D3825292C0929281C07271218174011_) {
                $body = str_replace($_obfuscated_0D3626291F0A240D3825292C0929281C07271218174011_, "<div class=\"aikopanel-no-access\">" . __("You must have a valid subscription to view content in this area") . "</div>", $body);
            }
        }
    }
    private function apple(&$body)
    {
        try {
            $_obfuscated_0D113B1B2C4023261D2F0F1B252B3010360719040D0222_ = ["ssl" => ["verify_peer" => false, "verify_peer_name" => false], "http" => ["timeout" => 5, "header" => ["Content-Type: application/json", "Accept: application/json, text/plain, */*"]]];
            $result = file_get_contents(config("aikopanel.appleid_api"), false, stream_context_create($_obfuscated_0D113B1B2C4023261D2F0F1B252B3010360719040D0222_));
            if($result === false) {
                throw new \Exception("Nếu thất bại không thành công, có một lỗi trong yêu cầu trang");
            }
            $_obfuscated_0D190118030D11115C0C1C1F02032D131F0D1B1B2C2F32_ = json_decode($result, true);
            if(json_last_error() != JSON_ERROR_NONE) {
                throw new \Exception("Có được lỗi, lỗi phân tích dữ liệu JSON, vui lòng kiểm tra xem đó có phải là Shareapi");
            }
            if($_obfuscated_0D190118030D11115C0C1C1F02032D131F0D1B1B2C2F32_["status"]) {
                $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_ = $_obfuscated_0D190118030D11115C0C1C1F02032D131F0D1B1B2C2F32_["accounts"];
                for ($i = 0; $i < sizeof($_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_); $i++) {
                    $body = str_replace("{{apple_id" . $i . "}}", $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_[$i]["username"], $body);
                    $body = str_replace("{{apple_pw" . $i . "}}", $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_[$i]["password"], $body);
                    $body = str_replace("{{apple_status" . $i . "}}", $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_[$i]["status"] ? "正常" : "异常", $body);
                    $body = str_replace("{{apple_time" . $i . "}}", $_obfuscated_0D25265B3F26050C0B30081F131816141C1E1A21362901_[$i]["last_check"], $body);
                }
            } else {
                $body = str_replace("{{apple_id0}}", "Thất bại," . $_obfuscated_0D190118030D11115C0C1C1F02032D131F0D1B1B2C2F32_["msg"], $body);
            }
        } catch (\Exception $ex) {
            $body = str_replace("{{apple_id0}}", $_obfuscated_0D18361A1925023804082B221F2C032A24011E27372811_, $body);
        }
    }
}

?>