<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http\Controllers\V1\Admin;

class ThemeController extends \App\Http\Controllers\Controller
{
    private $themes;
    private $path;
    public function __construct()
    {
        $this->path = $path = public_path("theme/");
        $this->themes = array_map(function ($item) use($item) {
            return str_replace($path, "", $item);
        }, glob($path . "*"));
    }
    public function getThemes()
    {
        $_obfuscated_0D1F29350C2C5C2836402C332105132108101133051611_ = [];
        foreach ($this->themes as $theme) {
            $_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_ = $this->path . $theme . "/config.json";
            if(!\Illuminate\Support\Facades\File::exists($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_)) {
            } else {
                $_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_ = json_decode(\Illuminate\Support\Facades\File::get($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_), true);
                if(!isset($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_["configs"]) || !is_array($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_)) {
                } else {
                    $_obfuscated_0D1F29350C2C5C2836402C332105132108101133051611_[$theme] = $_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_;
                    if(config("theme." . $theme)) {
                    } else {
                        $_obfuscated_0D1129341033032C2512070B1E13010D5B0A03361F3532_ = new \App\Services\ThemeService($theme);
                        $_obfuscated_0D1129341033032C2512070B1E13010D5B0A03361F3532_->init();
                    }
                }
            }
        }
        return response(["data" => ["themes" => $_obfuscated_0D1F29350C2C5C2836402C332105132108101133051611_, "active" => config("aikopanel.frontend_theme", "aikopanel")]]);
    }
    public function getThemeConfig(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_ = $request->validate(["name" => "required|in:" . join(",", $this->themes)]);
        return response(["data" => config("theme." . $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["name"])]);
    }
    public function saveThemeConfig(\Illuminate\Http\Request $request)
    {
        $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_ = $request->validate(["name" => "required|in:" . join(",", $this->themes), "config" => "required"]);
        $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"] = json_decode(base64_decode($_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"]), true);
        if(!$_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"] || !is_array($_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"])) {
            abort(500, "Tham số không hợp lệ");
        }
        $_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_ = public_path("theme/" . $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["name"] . "/config.json");
        if(!\Illuminate\Support\Facades\File::exists($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_)) {
            abort(500, "Chủ đề không tồn tại");
        }
        $_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_ = json_decode(\Illuminate\Support\Facades\File::get($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_), true);
        if(!isset($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_["configs"]) || !is_array($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_)) {
            abort(500, "Chủ đề không hợp lệ");
        }
        $_obfuscated_0D035C2A2508293D2B021237283B125C3C300D3D2C3E32_ = array_column($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_["configs"], "field_name");
        $config = [];
        foreach ($_obfuscated_0D035C2A2508293D2B021237283B125C3C300D3D2C3E32_ as $_obfuscated_0D303824350B0F02311B2302403F210711211E382F0F11_) {
            $config[$_obfuscated_0D303824350B0F02311B2302403F210711211E382F0F11_] = isset($_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"][$_obfuscated_0D303824350B0F02311B2302403F210711211E382F0F11_]) ? $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["config"][$_obfuscated_0D303824350B0F02311B2302403F210711211E382F0F11_] : "";
        }
        \Illuminate\Support\Facades\File::ensureDirectoryExists(base_path() . "/config/theme/");
        $data = var_export($config, 1);
        if(!\Illuminate\Support\Facades\File::put(base_path() . "/config/theme/" . $_obfuscated_0D400A0307291F1F245B052B140803012935072E162B32_["name"] . ".php", "<?php\n return " . $data . " ;")) {
            abort(500, "Lưu thất bại");
        }
        try {
            \Illuminate\Support\Facades\Artisan::call("config:cache");
        } catch (\Exception $ex) {
            abort(500, "Lưu thất bại");
        }
        return response(["data" => $config]);
    }
}

?>