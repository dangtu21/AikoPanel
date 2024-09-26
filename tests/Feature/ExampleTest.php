<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace Tests\Feature;

class ExampleTest extends \Tests\TestCase
{
    public function testBasicTest()
    {
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_ = $this->get("/");
        $_obfuscated_0D173C5B2F0F0718300A1B3C3F261317353F2E16072332_->assertStatus(200);
    }
}

?>