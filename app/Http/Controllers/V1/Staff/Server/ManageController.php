<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Staff\Server;

class ManageController extends \App\Http\Controllers\Controller
{
    public function getNodes(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_ = new \App\Services\ServerService();
        $_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ = $_obfuscated_0D373625010C0716341D17391C302D0E105C3D0E1F1D32_->getAllServers();
        $_obfuscated_0D0A013B303D171A102D2E08120713363611010B1E3C22_ = [];
        foreach ($_obfuscated_0D1F27402208265B08183F161A3D1A30293E34365B5C32_ as $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_) {
            if($_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_["show"] == 0) {
            } else {
                $_obfuscated_0D0A013B303D171A102D2E08120713363611010B1E3C22_[] = $_obfuscated_0D0D125B14041A2F282233210F172D2A320F282D252D01_;
            }
        }
        return response(["data" => $_obfuscated_0D0A013B303D171A102D2E08120713363611010B1E3C22_]);
    }
}

?>