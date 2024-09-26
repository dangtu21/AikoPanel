<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace Tests;

trait CreatesApplication
{
    public function createApplication()
    {
        $_obfuscated_0D3C333003010E2B315C123208143F37351D34080A2C01_ = (require __DIR__ . "/../bootstrap/app.php");
        $_obfuscated_0D3C333003010E2B315C123208143F37351D34080A2C01_->make("Illuminate\\Contracts\\Console\\Kernel")->bootstrap();
        return $_obfuscated_0D3C333003010E2B315C123208143F37351D34080A2C01_;
    }
}

?>