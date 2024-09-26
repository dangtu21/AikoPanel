<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace Library;

class AlipayF2F
{
    private $appId;
    private $privateKey;
    private $alipayPublicKey;
    private $signType = "RSA2";
    public $bizContent;
    public $method;
    public $notifyUrl;
    public $response;
    public function __construct()
    {
    }
    public function verify($data)
    {
        if(is_string($data)) {
            parse_str($data, $data);
        }
        $_obfuscated_0D0E210B1717152C020C07163622023F24070304343732_ = $data["sign"];
        unset($data["sign"]);
        unset($data["sign_type"]);
        ksort($data);
        $data = $this->buildQuery($data);
        $res = "-----BEGIN PUBLIC KEY-----\n" . wordwrap($this->alipayPublicKey, 64, "\n", true) . "\n-----END PUBLIC KEY-----";
        if("RSA2" == $this->signType) {
            $result = openssl_verify($data, base64_decode($_obfuscated_0D0E210B1717152C020C07163622023F24070304343732_), $res, OPENSSL_ALGO_SHA256) === 1;
        } else {
            $result = openssl_verify($data, base64_decode($_obfuscated_0D0E210B1717152C020C07163622023F24070304343732_), $res) === 1;
        }
        openssl_free_key(openssl_get_publickey($res));
        return $result;
    }
    public function setBizContent($bizContent = [])
    {
        $this->bizContent = json_encode($bizContent);
    }
    public function setMethod($method)
    {
        $this->method = $method;
    }
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }
    public function setAlipayPublicKey($alipayPublicKey)
    {
        $this->alipayPublicKey = $alipayPublicKey;
    }
    public function setNotifyUrl($url)
    {
        $this->notifyUrl = $url;
    }
    public function send()
    {
        $response = \Illuminate\Support\Facades\Http::get("https://openapi.alipay.com/gateway.do", $this->buildParam())->json();
        $_obfuscated_0D0A0C2C40353C37352A1B3D11080C4012110B031E1911_ = str_replace(".", "_", $this->method) . "_response";
        if(!isset($response[$_obfuscated_0D0A0C2C40353C37352A1B3D11080C4012110B031E1911_])) {
            throw new \Exception("从支付宝请求失败");
        }
        $response = $response[$_obfuscated_0D0A0C2C40353C37352A1B3D11080C4012110B031E1911_];
        if($response["msg"] !== "Success") {
            throw new \Exception($response["sub_msg"]);
        }
        $this->response = $response;
    }
    public function getQrCodeUrl()
    {
        $response = $this->response;
        if(!isset($response["qr_code"])) {
            throw new \Exception("获取付款二维码失败");
        }
        return $response["qr_code"];
    }
    public function getResponse()
    {
        return $this->response;
    }
    public function buildParam() : array
    {
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = ["app_id" => $this->appId, "method" => $this->method, "charset" => "UTF-8", "sign_type" => $this->signType, "timestamp" => date("d-m-Y H:m:s"), "biz_content" => $this->bizContent, "version" => "1.0", "_input_charset" => "UTF-8"];
        if($this->notifyUrl) {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["notify_url"] = $this->notifyUrl;
        }
        ksort($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_["sign"] = $this->buildSign($this->buildQuery($_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_));
        return $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_;
    }
    public function buildQuery($query)
    {
        if(!$query) {
            throw new \Exception("参数构造错误");
        }
        ksort($query);
        $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_ = [];
        foreach ($query as $key => $value) {
            $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_[] = $key . "=" . $value;
        }
        $data = implode("&", $_obfuscated_0D5C34102C3C3C1E36121C1F3B39111A0D013210400E01_);
        return $data;
    }
    private function buildSign($signData)
    {
        $privateKey = $this->privateKey;
        $_obfuscated_0D1E29013F1F0D12150A0522222707140A132B160D1332_ = [];
        if(!stripos($privateKey, "\n")) {
            for ($i = 0; $_obfuscated_0D19230F263E0329210837081536392B15270C34282D32_ = substr($privateKey, $i * 64, 64); $i++) {
                $_obfuscated_0D1E29013F1F0D12150A0522222707140A132B160D1332_[] = $_obfuscated_0D19230F263E0329210837081536392B15270C34282D32_;
            }
        }
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" . implode("\n", $_obfuscated_0D1E29013F1F0D12150A0522222707140A132B160D1332_);
        $privateKey = $privateKey . "\n-----END RSA PRIVATE KEY-----";
        $_obfuscated_0D1D273B2F031C2B0331293C353D190729281532162922_ = openssl_pkey_get_private($privateKey, "");
        $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_ = "";
        if("RSA2" == $this->signType) {
            openssl_sign($signData, $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_, $_obfuscated_0D1D273B2F031C2B0331293C353D190729281532162922_, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($signData, $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_, $_obfuscated_0D1D273B2F031C2B0331293C353D190729281532162922_, OPENSSL_ALGO_SHA1);
        }
        openssl_free_key($_obfuscated_0D1D273B2F031C2B0331293C353D190729281532162922_);
        $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_ = base64_encode($_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_);
        return $_obfuscated_0D5B2B131634220A220B5B313E402A25070F3F342E2622_;
    }
}

?>