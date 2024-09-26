<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Services;

class ThemeService
{
    private $path;
    private $theme;
    public function __construct($theme)
    {
        $this->theme = $theme;
        $this->path = $path = public_path("theme/");
    }
    public function init()
    {
        $_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_ = $this->path . $this->theme . "/config.json";
        if(!\Illuminate\Support\Facades\File::exists($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_)) {
            abort(500, $this->theme . " Chủ đề không tồn tại");
        }
        $_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_ = json_decode(\Illuminate\Support\Facades\File::get($_obfuscated_0D35021F0D11402B042418281809311F39073E1E030332_), true);
        if(!isset($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_["configs"]) || !is_array($_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_)) {
            abort(500, $this->theme . " Tệp cấu hình chủ đề sai");
        }
        $_obfuscated_0D0E2E1B3E0A1D28121517151E350232110F281C383232_ = $_obfuscated_0D0228320212180D170D0919041B2E143D3E3F35401532_["configs"];
        $data = [];
        foreach ($_obfuscated_0D0E2E1B3E0A1D28121517151E350232110F281C383232_ as $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_) {
            $data[$_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["field_name"]] = isset($_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["default_value"]) ? $_obfuscated_0D1C2E3B252D3B2C3E162B17052813182B2B121D092D22_["default_value"] : "";
        }
        $data = var_export($data, 1);
        try {
            if(!\Illuminate\Support\Facades\File::put(base_path() . "/config/theme/" . $this->theme . ".php", "<?php\n return " . $data . " ;")) {
                abort(500, $this->theme . " Khởi tạo không thành công");
            }
        } catch (\Exception $ex) {
            abort(500, "Vui lòng kiểm tra Cơ quan thư mục AikoPanel");
        }
        try {
            \Illuminate\Support\Facades\Artisan::call("config:cache");
            while (true) {
                if(config("theme." . $this->theme)) {
                }
            }
        } catch (\Exception $ex) {
            abort(500, $this->theme . " Khởi tạo không thành công");
        }
    }
}

?>