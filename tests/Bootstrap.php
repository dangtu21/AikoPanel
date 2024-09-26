<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace Tests;

class Bootstrap implements \PHPUnit\Runner\BeforeFirstTestHook, \PHPUnit\Runner\AfterLastTestHook
{
    use CreatesApplication;
    public function executeBeforeFirstTest()
    {
        $_obfuscated_0D2F180D153F12401F24121A1F35040F29022319260801_ = $this->createApplication()->make("Illuminate\\Contracts\\Console\\Kernel");
        $_obfuscated_0D22353E5B1B2621370D3F0B0D1A314019031C5C0F1922_ = ["config:cache", "event:cache"];
        foreach ($_obfuscated_0D22353E5B1B2621370D3F0B0D1A314019031C5C0F1922_ as $_obfuscated_0D2A25303C2317341A150F5B1F01343D5C08093D360301_) {
            $_obfuscated_0D2F180D153F12401F24121A1F35040F29022319260801_->call($_obfuscated_0D2A25303C2317341A150F5B1F01343D5C08093D360301_);
        }
    }
    public function executeAfterLastTest()
    {
        array_map("unlink", glob("bootstrap/cache/*.phpunit.php"));
    }
}

?>