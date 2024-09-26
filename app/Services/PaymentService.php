<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class PaymentService
{
    public $method;
    protected $class;
    protected $config;
    protected $payment;
    public function __construct($method, $id = NULL, $uuid = NULL)
    {
        $this->method = $method;
        $this->class = "\\App\\Payments\\" . $this->method;
        if(!class_exists($this->class)) {
            abort(500, "gate is not found");
        }
        if($id) {
            $payment = \App\Models\Payment::find($id)->toArray();
        }
        if($uuid) {
            $payment = \App\Models\Payment::where("uuid", $uuid)->first()->toArray();
        }
        $this->config = [];
        if(isset($payment)) {
            $this->config = $payment["config"];
            $this->config["enable"] = $payment["enable"];
            $this->config["id"] = $payment["id"];
            $this->config["uuid"] = $payment["uuid"];
            $this->config["notify_domain"] = $payment["notify_domain"];
        }
        $this->payment = new $this->class($this->config);
    }
    public function notify($params)
    {
        if(!$this->config["enable"]) {
            abort(500, "gate is not enable");
        }
        return $this->payment->notify($params);
    }
    public function pay($order)
    {
        $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_ = url("/api/v1/guest/payment/notify/" . $this->method . "/" . $this->config["uuid"]);
        if($this->config["notify_domain"]) {
            $_obfuscated_0D2A3C1F2C13243B333527173C3219150B5B1711092E01_ = parse_url($_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_);
            $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_ = $this->config["notify_domain"] . $_obfuscated_0D2A3C1F2C13243B333527173C3219150B5B1711092E01_["path"];
        }
        $_obfuscated_0D05241002302A5B280E3D1F290E133E1C181D37111932_ = config("aikopanel.app_url");
        $_obfuscated_0D371F071E1F151A032A13355C1A141A031C2725391A11_ = request()->getSchemeAndHttpHost();
        $_obfuscated_0D381D393831275B1C141D29070814275C0D2325210C32_ = $_obfuscated_0D371F071E1F151A032A13355C1A141A031C2725391A11_ ? $_obfuscated_0D371F071E1F151A032A13355C1A141A031C2725391A11_ . "/#/order/" . $order["trade_no"] : $_obfuscated_0D05241002302A5B280E3D1F290E133E1C181D37111932_ . "/#/order/" . $order["trade_no"];
        return $this->payment->pay(["notify_url" => $_obfuscated_0D1614133B5B2D3D162A1A1A253D3F3E01063F400E0D22_, "return_url" => $_obfuscated_0D381D393831275B1C141D29070814275C0D2325210C32_, "trade_no" => $order["trade_no"], "total_amount" => $order["total_amount"], "user_id" => $order["user_id"], "order_id" => $order["order_id"], "stripe_token" => $order["stripe_token"]]);
    }
    public function form()
    {
        $form = $this->payment->form();
        $_obfuscated_0D1825163F223702242511222122220D1E321E0A313F32_ = array_keys($form);
        foreach ($_obfuscated_0D1825163F223702242511222122220D1E321E0A313F32_ as $key) {
            if(isset($this->config[$key])) {
                $form[$key]["value"] = $this->config[$key];
            }
        }
        return $form;
    }
}

?>