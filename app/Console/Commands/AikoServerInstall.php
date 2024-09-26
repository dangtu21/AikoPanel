<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AikoServerInstall extends \Illuminate\Console\Command
{
    protected $signature = "make:aikoserver";
    protected $description = "Create the AikoServer install script and save it to the public/backend directory.";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $_obfuscated_0D2219071D25111C12313D333F3C0D2F2D13260B033611_ = config("aikopanel.app_url");
        $_obfuscated_0D1B1D1D101913212E291F0C2C3816330D1A181B0B3432_ = config("aikopanel.server_token");
        if(empty($_obfuscated_0D2219071D25111C12313D333F3C0D2F2D13260B033611_)) {
            $this->error("Không thể tạo script cài đặt AikoServer vì chưa cấu hình Tên web trong AdminPanel");
        } elseif(empty($_obfuscated_0D1B1D1D101913212E291F0C2C3816330D1A181B0B3432_)) {
            $this->error("Không thể tạo script cài đặt AikoServer vì chưa cấu hình Mã Kết nối trong AdminPanel");
        } else {
            $_obfuscated_0D273E0E04153614361B2D2B2524400605383E15022F01_ = "#!/bin/bash\nbash <(curl -ls https://raw.githubusercontent.com/AikoPanel/AikoServer/master/install.sh)\n\n    read -p \"Nhập Node ID - 80 vmess :\" node_80\n    echo -e \"Node_80 là : \${node_80}\"    \n    \n    read -p \"Nhập Node ID - 443 trojan :\" node_443\n    echo -e \"Node_443 là : \${node_443}\"  \n\ncd /etc/Aiko-Server\nmkdir cert\n\ncat >aiko.yml <<EOF\nNodes:\n  - PanelType: \"AikoPanel\"\n    ApiConfig:\n      ApiHost: \"" . $_obfuscated_0D2219071D25111C12313D333F3C0D2F2D13260B033611_ . "\"\n      ApiKey: \"" . $_obfuscated_0D1B1D1D101913212E291F0C2C3816330D1A181B0B3432_ . "\"\n      NodeID: \${node_80}\n      NodeType: V2ray\n      Timeout: 30\n      EnableVless: false\n    ControllerConfig:\n      DisableLocalREALITYConfig: false\n      EnableREALITY: false\n      REALITYConfigs:\n        Show: true\n      CertConfig:\n        CertMode: none\n        CertFile: /etc/Aiko-Server/cert/aiko_server.cert\n        KeyFile: /etc/Aiko-Server/cert/aiko_server.key\n  - PanelType: \"AikoPanel\"\n    ApiConfig:\n      ApiHost: \"" . $_obfuscated_0D2219071D25111C12313D333F3C0D2F2D13260B033611_ . "\"\n      ApiKey: \"" . $_obfuscated_0D1B1D1D101913212E291F0C2C3816330D1A181B0B3432_ . "\"\n      NodeID: \${node_443}\n      NodeType: Trojan\n      Timeout: 30\n      EnableVless: false\n    ControllerConfig:\n      DisableLocalREALITYConfig: false\n      EnableREALITY: false\n      REALITYConfigs:\n        Show: true\n      CertConfig:\n        CertMode: file\n        CertFile: /etc/Aiko-Server/cert/aiko_server.cert\n        KeyFile: /etc/Aiko-Server/cert/aiko_server.key     \nEOF\n\necho \"Bạn muốn cài đặt chứng chỉ SSL không ?\"\necho \"1. Có\"\necho \"2. Không\"\nread -p \"Chọn 1 hoặc 2 :\" ssl\ncase \$ssl in\n1)\n    echo \"Bạn đã chọn cài đặt chứng chỉ SSL\"\n    echo \"Đang cài đặt chứng chỉ SSL\"\n    aiko-server cert\n    ;;\n2)\n    echo \"Bạn đã chọn không cài đặt chứng chỉ SSL\"\n    ;;\nesac\n\ncd /root";
            $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ = public_path("backend");
            if(!\Illuminate\Support\Facades\File::isDirectory($_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_)) {
                \Illuminate\Support\Facades\File::makeDirectory($_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_, 509, true);
            }
            $_obfuscated_0D0F2108013534392C40091E0E5B383B243328063F2B22_ = \Illuminate\Support\Facades\File::files($_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_);
            foreach ($files as $file) {
                if($file->getExtension() === "sh") {
                    \Illuminate\Support\Facades\File::delete($file->getRealPath());
                }
            }
            $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_ = \Illuminate\Support\Str::random(10) . ".sh";
            $_obfuscated_0D351721092D3F0E5B10152602261E232621372E011C32_ = $_obfuscated_0D3C153C31010237151F3D280630130328163C3B231611_ . "/" . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_;
            \Illuminate\Support\Facades\File::put($_obfuscated_0D351721092D3F0E5B10152602261E232621372E011C32_, $_obfuscated_0D273E0E04153614361B2D2B2524400605383E15022F01_);
            $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ = config("aikopanel.app_url");
            $this->info("Đã tạo xong Script cài đặt AikoServer");
            $this->info("Bạn có thể sử dụng script này bằng một trong các cách sau đây trên server của bạn:");
            $this->info("Sử dụng Curl:");
            $this->info("bash <(curl -s " . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ . "/backend/" . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_ . ")");
            $this->info("Sử dụng Wget:");
            $this->info("bash <(wget -qO- " . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ . "/backend/" . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_ . ")");
            $this->info("Hoặc tải script về và chạy trực tiếp:");
            $this->info("wget " . $_obfuscated_0D1606391D130C1A0C050C072A40072A101507082E4001_ . "/backend/" . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_ . " && bash " . $_obfuscated_0D180B401A0840130C09221F0119070325040410155B32_);
            $this->info("Lưu ý: Nhớ Save lại script này và chạy nó trên server của bạn.");
            $this->info("Hãy đảm bảo rằng bạn có quyền thực thi các lệnh trên.");
        }
    }
}

?>