<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Scope;

trait FilterScope
{
    public function scopeSetFilterAllowKeys($builder, ...$allowKeys)
    {
        $allowKeys = implode(",", $allowKeys);
        if(!$allowKeys) {
            return $builder;
        }
        $_obfuscated_0D1318243B100E5C0E34400806052B280A2D2216290D01_ = request();
        $request->validate(["filter.*.key" => "required|in:" . $allowKeys, "filter.*.condition" => "required|in:in,is,not,like,lt,gt", "filter.*.value" => "required"]);
        $_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_ = $request->input("filter");
        if($_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_) {
            foreach ($_obfuscated_0D04030823262A5B2215220B10030E1D24120A17211D22_ as $k => $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_) {
                if($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "in") {
                    $builder->whereIn($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"]);
                } elseif($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "is") {
                    $builder->where($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"]);
                } elseif($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "not") {
                    $builder->where($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], "!=", $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"]);
                } elseif($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "gt") {
                    $builder->where($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], ">", $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"]);
                } elseif($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "lt") {
                    $builder->where($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], "<", $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"]);
                } elseif($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["condition"] === "like") {
                    $builder->where($_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["key"], "like", "%" . $_obfuscated_0D3C04221E040A400930401F1B1A0237053F5B192B3C32_["value"] . "%");
                }
            }
        }
        return $builder;
    }
}

?>