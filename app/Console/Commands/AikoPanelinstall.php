<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class AikoPanelInstall extends \Illuminate\Console\Command
{
    protected $signature = "aikopanel:install";
    protected $description = "Cài đặt AikoPanel";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        try {
            $this->info("    _                       _  __       U  ___ u ");
            $this->info("   /\"\\  u       ___        |\"|/ /        \\/\"_ \\/ ");
            $this->info(" \\/ _ \\/        |\"_|       | ' /         | | | | ");
            $this->info(" / ___ \\        | |      U/| . \\\\u   .-,_| |_| | ");
            $this->info("/_/   \\_\\     U/| |\\u      |_|\\_\\     \\_)-\\___/  ");
            $this->info(" \\\\    >>  .-,_|___|_,-.  ,-,>> \\\\,-.       \\\\    ");
            $this->info(" (__) (__)  \\_)-' '-(_/    \\.)   (_/       (__)   ");
            $this->info("                                                  ");
            $this->info("--------------------------------------------------");
            if(\File::exists(base_path() . "/.env")) {
                $_obfuscated_0D353D2E31121C2D1B2235165C37122B400508285C1032_ = config("aikopanel.secure_path", config("aikopanel.frontend_admin_path", "aikopanel"));
                $_obfuscated_0D07041111272A311F2C220634352608083135402F0832_ = config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel"));
                $this->info("------------------------------------------------");
                $this->info("Truy cập http(s)://your-website/" . $_obfuscated_0D353D2E31121C2D1B2235165C37122B400508285C1032_ . " để truy cập vào bảng điều khiển quản trị. Bạn có thể thay đổi mật khẩu của mình trong Trung tâm người dùng.");
                $this->info("Truy cập http(s)://your-website/" . $_obfuscated_0D07041111272A311F2C220634352608083135402F0832_ . " để truy cập vào bảng điều khiển nhân viên. Bạn có thể thay đổi mật khẩu của mình trong Trung tâm người dùng.");
                abort(500, "Nếu bạn muốn cài đặt lại, vui lòng xóa tệp .env trong thư mục.");
            }
            if(!copy(base_path() . "/.env.example", base_path() . "/.env")) {
                abort(500, "Sao chép tệp môi trường thất bại, vui lòng kiểm tra quyền truy cập của thư mục.");
            }
            $this->saveToEnv(["APP_KEY" => "base64:" . base64_encode(\Illuminate\Encryption\Encrypter::generateKey("AES-256-CBC")), "DB_HOST" => $this->ask("Nhập địa chỉ database (mặc định: localhost)", "localhost"), "DB_DATABASE" => $this->ask("Vui lòng nhập tên database"), "DB_USERNAME" => $this->ask("Vui lòng nhập tên người dùng database"), "DB_PASSWORD" => $this->ask("Vui lòng nhập mật khẩu database")]);
            \Artisan::call("config:clear");
            \Artisan::call("config:cache");
            \Artisan::call("cache:clear");
            $this->info("Vui lòng đợi một chút khi bạn làm trống cơ sở dữ liệu");
            \Artisan::call("db:wipe", ["--quiet" => true]);
            $this->info("Cơ sở dữ liệu đã hoàn tất");
            $this->info("Vui lòng đợi cơ sở dữ liệu được nhập vào cơ sở dữ liệu...");
            \Artisan::call("migrate", ["--quiet" => true]);
            $this->info(\Artisan::output());
            $this->info("Chào mừng bạn đến với AikoPanel!");
            $this->info("Hướng dẫn cơ sở dữ liệu được hoàn thành");
            $this->info("Vui lòng đợi một chút khi bạn tạo tài khoản quản trị viên");
            $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_ = "";
            while (!$_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_) {
                $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_ = $this->ask("Vui lòng nhập địa chỉ email của admin");
            }
            $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ = \App\Utils\Helper::guid(false);
            if(!$this->registerAdmin($_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_, $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_)) {
                abort(500, "Đăng ký tài khoản quản trị viên thất bại, vui lòng thử lại.");
            }
            $this->info("Mọi thứ đã sẵn sàng!");
            $this->info("Email admin: " . $_obfuscated_0D1036250C181C1F3230040D2C22172B1E4023275B2922_);
            $this->info("Mật khẩu admin：" . $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_);
            $this->info("----------------------------------------");
            $_obfuscated_0D1C331E05390B151002153D3207260534090B351C0122_ = "aikopanel";
            $_obfuscated_0D183306062109301104343E250D1E103024332D1A2122_ = "staffaikopanel";
            $this->info("Truy cập http(s)://your-website/" . $_obfuscated_0D1C331E05390B151002153D3207260534090B351C0122_ . " để truy cập vào bảng điều khiển quản trị. Bạn có thể thay đổi mật khẩu của mình trong Trung tâm người dùng.");
            $this->info("----------------------------------------");
            $this->info("Truy cập http(s)://your-website/" . $_obfuscated_0D183306062109301104343E250D1E103024332D1A2122_ . " để truy cập vào bảng điều khiển nhân viên. Bạn có thể thay đổi mật khẩu của mình trong Trung tâm người dụng.");
        } catch (\Exception $ex) {
            $this->error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
        }
    }
    private function registerAdmin($email, $password)
    {
        $user = new \App\Models\User();
        $user->email = $email;
        if(strlen($password) < 8) {
            abort(500, "Mật khẩu quản trị viên phải có ít nhất 8 ký tự.");
        }
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->uuid = \App\Utils\Helper::guid(true);
        $user->token = \App\Utils\Helper::guid();
        $user->is_admin = 1;
        $user->is_staff = 1;
        return $user->save();
    }
    private function saveToEnv($data = [])
    {
        function set_env_var($key, $value)
        {
            if(!is_bool(strpos($value, " "))) {
                $value = "\"" . $value . "\"";
            }
            $key = strtoupper($key);
            $_obfuscated_0D1928180913182426090D323238233F2510192D125C22_ = app()->environmentFilePath();
            $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_ = file_get_contents($_obfuscated_0D1928180913182426090D323238233F2510192D125C22_);
            preg_match("/^" . $key . "=[^\r\n]*/m", $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_, $_obfuscated_0D303639222B5C5B22211E2A28033003281C5C341D1622_);
            $_obfuscated_0D060F180A12060E29251D19131411262535101E100D11_ = count($_obfuscated_0D303639222B5C5B22211E2A28033003281C5C341D1622_) ? $_obfuscated_0D303639222B5C5B22211E2A28033003281C5C341D1622_[0] : "";
            if($_obfuscated_0D060F180A12060E29251D19131411262535101E100D11_) {
                $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_ = str_replace((string) $_obfuscated_0D060F180A12060E29251D19131411262535101E100D11_, $key . "=" . $value, $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_);
            } else {
                $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_ = $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_ . "\n" . $key . "=" . $value . "\n";
            }
            $file = fopen($_obfuscated_0D1928180913182426090D323238233F2510192D125C22_, "w");
            fwrite($file, $_obfuscated_0D0E083D26342D29261D182630105C3F361C040E2C0E11_);
            return fclose($file);
        }
        foreach ($data as $key => $value) {
            set_env_var($key, $value);
        }
        return true;
    }
}

?>