<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class ResetPassword extends \Illuminate\Console\Command
{
    protected $builder;
    protected $signature = "reset:password {email}";
    protected $description = "Nhiệm vụ đặt lại mật khẩu người dùng";
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $user = \App\Models\User::where("email", $this->argument("email"))->first();
        if(!$user) {
            abort(500, "Email không tồn tại");
        }
        $_obfuscated_0D383F253633081F07090C4004100F070E0F3537070622_ = \App\Utils\Helper::guid(false);
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->password_algo = NULL;
        if(!$user->save()) {
            abort(500, "Cài lại");
        }
        $this->info("!!! Đặt lại thành công !!!");
        $this->info("Mật khẩu mới là: " . $password . ", vui lòng sửa đổi mật khẩu càng sớm càng tốt.");
    }
}

?>