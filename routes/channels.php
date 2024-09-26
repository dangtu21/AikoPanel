<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
Broadcast::channel("App.User.{id}", function ($user, $id) {
    return (int) $user->id === (int) $id;
});

?>