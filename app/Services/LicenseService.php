<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class LicenseService
{
    protected $iss = "3b8affac3b94c3bb42b3f883471bb107";
    protected $uuid;
    protected $pk;
    protected $license;
    public function __construct()
    {
        $this->setUuidAndPublicKey();
    }
    public function isLicenseValid()
    {
        return $this->check();
    }
    public function isLicenseValidWithDomain($currentDomain)
    {
        $license = \Illuminate\Support\Facades\Cache::get("license_" . $currentDomain);
        if($license === NULL) {
            return false;
        }
        return true;
    }
    public function setUuidAndPublicKey()
    {
        $_obfuscated_0D361A3B291B5C262F040826241B382A153C40033B1132_ = base_path() . "/data/certs/aikopanel";
        $this->uuid = "e9547c38-d0fa-46cd-8856-a54a4a48da63";
        $this->pk = $this->getPublicKeyOne();
        $this->license = config("aikopanel.license");
    }
    public function getPublicKeyOne()
    {
        return "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3ZxzTH1UG0iEXQUTlqGH\nJLW0Sy1aRHRCoPHwQHOQxj4PSfBHXzOzOhFfPIOneNCMt0l5RRbWfBx/PUmdv44+\nZL/tiwt1oo7HbGdVAveEtFjNmU9FgKa0KIdE1OtmhKCy43oJ+C3F6dYe2UiO8MAN\nGtorf1QiZaRvgP5LGl0RYBcrpJon6BncucttSoVSaX4bcaU+4taUjamRix3ZFM5Z\nZc3r7rU7aZ1EbpWRLHqe4HPNZhrunM63A2Tz7ByPFPJZStNFpPs1nTRzTDN4Ghrg\n6sZtndHC4sKmpHAuNtIgEsm9nMiKvu6yqUq1h75MxW4edNuFrrj9zuuDWlURas+P\nIQIDAQAB\n-----END PUBLIC KEY-----        ";
    }
    public function getPublicKeyTwo()
    {
        return "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA3Wf1ku/WBM94NDceaLsn\nLo/IbQ6UkOtGZUM4GgH0DIvs3FN5kcALz/XcTemGff8vzpywtv0z7KMPVJBRG2Al\nPfkuVRNKyznN8VrIQLmB8b5A3/39jQRXbc7ZIExisNNK5fgjSzMZkAkiIITw8vl1\nD8fIu2YB4cEkzDskPSU/E8ZEXsQbJG6rGa/76Kx0TO8HA4Snd5ITgCksfFMdY/v/\ndFfPrwTvcbUtYYtSeeeICpf+jM9bDbhHZ5DML7fehkLCMwtPLwbiptN3991AakaW\nPbGXLpFbjpRhfqtzGFvBGF16O6EKY4ZeITK0orApnngUh9zk/znwYXrbzgrz8uRF\n4wIDAQAB\n-----END PUBLIC KEY-----";
    }
    public function check()
    {
        $currentDomain = $this->getCurrentDomain();
        $this->refreshLicense($currentDomain);
        $license = \Illuminate\Support\Facades\Cache::get("license_" . $currentDomain);
        if($license === NULL) {
            return false;
        }
        $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_ = $this->JWT_decode($license);
        return $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["ret"] === 1 && $this->verifyLicense($_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["data"]);
    }
    public function getCurrentDomain()
    {
        $url = request()->getHost();
        return parse_url(config("aikopanel.app_url", "example.com"), PHP_URL_HOST) ?? $url;
    }
    public function refreshLicense($currentDomain)
    {
        if(\Illuminate\Support\Facades\Cache::has("license_" . $currentDomain)) {
            return NULL;
        }
        $_obfuscated_0D0412253632331B390B0F30095B32221F122505360132_ = base_path() . "/data/certs/aikopanel";
        if(\Illuminate\Support\Facades\File::exists($_obfuscated_0D0412253632331B390B0F30095B32221F122505360132_)) {
            $this->cacheLicenseFromFile($currentDomain, $_obfuscated_0D0412253632331B390B0F30095B32221F122505360132_);
        } elseif($this->license !== NULL) {
            $this->fetchAndCacheLicense($currentDomain);
        }
    }
    public function cacheLicenseFromFile($currentDomain, $licensePath)
    {
        $_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_ = file_get_contents($licensePath);
        if($_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_ !== false) {
            \Illuminate\Support\Facades\Cache::put("license_" . $currentDomain, $_obfuscated_0D3B2F141F2B1D191D2E1F3D093D191E191B0B39091532_, 28800);
        }
    }
    public function fetchAndCacheLicense($currentDomain)
    {
        $ip = \App\Utils\Helper::getIp();
        $data = ["domain" => $currentDomain, "ip" => $ip, "uuid" => $this->uuid, "key" => $this->license];
        $result = $this->curl("https://license.aikocute.net/client/verify", $data);
        if($result["ret"] === 1) {
            $this->cacheLicenseResponse($currentDomain, $result);
        }
    }
    public function cacheLicenseResponse($currentDomain, array $result)
    {
        $ip = \App\Utils\Helper::getIp();
        if(\Illuminate\Support\Facades\Cache::missing("report_key_" . $currentDomain)) {
            \App\Utils\Helper::notifyViaTelegram("🌎Domain: " . $currentDomain . "\nIP: " . $ip . "\n- Đã kích hoat AikoPanel với Key: `" . $this->license . "`\n-✅ Thành công");
            \Illuminate\Support\Facades\Cache::put("report_key_" . $currentDomain, $result["data"]);
        }
        \Illuminate\Support\Facades\Cache::put("license_" . $currentDomain, $result["data"], 28800);
    }
    public function curl($URL, array $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_CAINFO, base_path() . "/data/certs/cacert.pem");
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Strict-Transport-Security: max-age=31536000"]);
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = curl_exec($ch);
        if(curl_errno($ch)) {
            curl_close($ch);
            return ["ret" => 0, "msg" => "Yêu cầu thất bại", "data" => []];
        }
        $_obfuscated_0D0F3727232F09182D05195C2D35152927281806390E32_ = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $_obfuscated_0D5C3F25031C31361229241433330E27031C3923023411_ = json_decode($_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_, true);
        curl_close($ch);
        if($_obfuscated_0D0F3727232F09182D05195C2D35152927281806390E32_ == 200 && isset($_obfuscated_0D5C3F25031C31361229241433330E27031C3923023411_["ret"]) && $_obfuscated_0D5C3F25031C31361229241433330E27031C3923023411_["ret"] == 1 && isset($_obfuscated_0D5C3F25031C31361229241433330E27031C3923023411_["data"])) {
            return ["ret" => 1, "msg" => "Yêu cầu thành công", "data" => $_obfuscated_0D5C3F25031C31361229241433330E27031C3923023411_["data"]];
        }
        return ["ret" => 0, "msg" => "Yêu cầu thất bại", "data" => []];
    }
    public function JWT_decode($data)
    {
        $_obfuscated_0D140C10342A402F033F1E3236240C020E0D0429360C01_ = $this->pk;
        try {
            $_obfuscated_0D1E0D380E100A1B100D1F23261F062D3B3B1203043022_ = \Firebase\JWT\JWT::decode($data, new \Firebase\JWT\Key($_obfuscated_0D140C10342A402F033F1E3236240C020E0D0429360C01_, "RS256"));
        } catch (\Exception $ex) {
            return ["ret" => 0, "msg" => "Giải mã JWT thất bại", "data" => []];
        }
        $data = explode(".", $data);
        if(sizeof($data) != 3) {
            return ["ret" => 0, "msg" => "Số lượng mục JWT không chính xác", "data" => []];
        }
        $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_ = json_decode(base64_decode($data[1]), true);
        $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_ = base64_decode(strtr($data[2], "-_", "+/"));
        $_obfuscated_0D083E160B5B2D3E30272A27383B1705041B31091D3322_ = openssl_verify($data[0] . "." . $data[1], $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_, $_obfuscated_0D140C10342A402F033F1E3236240C020E0D0429360C01_, "sha256WithRSAEncryption");
        if(!$_obfuscated_0D083E160B5B2D3E30272A27383B1705041B31091D3322_) {
            return ["ret" => 0, "msg" => "Có vẻ chứng chỉ đã bị sửa đổi", "data" => []];
        }
        return ["ret" => 1, "msg" => "Xác minh chứng chỉ thành công", "data" => $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_];
    }
    public function verifyLicense($payload)
    {
        if($payload["ret"] != 1) {
            return false;
        }
        if(!(isset($payload["nbf"]) && isset($payload["exp"]) && isset($payload["iss"]) && isset($payload["pid"]) && isset($payload["key"]))) {
            return false;
        }
        return $payload["nbf"] <= time() && time() <= $payload["exp"] && $payload["iss"] == $this->iss && $payload["pid"] == $this->uuid && $payload["key"] == $this->license && $this->isValidAudience($payload["aud"]);
    }
    public function isValidAudience($audience)
    {
        $url = request()->getHost();
        $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = request()->path();
        $_obfuscated_0D2F03040F232B341E13030826052F26231B1E330B1322_ = config("aikopanel.sub_app_url") ?? [];
        $_obfuscated_0D0C2E153505030E11043B2127132929303E041A190301_ = config("aikopanel.sub_domain") ?? [];
        $_obfuscated_0D313D0822142D1E122B1D1D1E3D21270431243D182A11_ = array_merge($_obfuscated_0D2F03040F232B341E13030826052F26231B1E330B1322_, $_obfuscated_0D0C2E153505030E11043B2127132929303E041A190301_);
        if($path != "api/v1/client/subscribe") {
            return $audience == $url || in_array($url, $_obfuscated_0D313D0822142D1E122B1D1D1E3D21270431243D182A11_);
        }
        $currentDomain = $this->getCurrentDomain();
        return $audience == $currentDomain;
    }
}

?>