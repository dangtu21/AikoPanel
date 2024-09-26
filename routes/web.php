<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
Route::get("/", function (Illuminate\Http\Request $request) {
    $url = $request->server("HTTP_HOST");
    $main_domain = parse_url(config("aikopanel.app_url"))["host"];
    $sub_app_url = config("aikopanel.sub_app_url") ?? [];
    $staff_sub_domain = config("aikopanel.sub_domain") ?? [];
    $sub_domain = array_merge($sub_app_url, $staff_sub_domain);
    if(config("aikopanel.maintenance_mode_enable", 0)) {
        return view("maintenance.maintenance", ["title" => config("aikopanel.app_name", "AikoPanel"), "support" => config("aikopanel.telegram_discuss_link") ?? config("aikopanel.zalo_discuss_link") ?? "https://t.me/AikoPanel"]);
    }
    if(config("aikopanel.app_url") && config("aikopanel.safe_mode_enable", 0) && !in_array($url, $sub_domain) && $url !== $main_domain) {
        abort(403);
    }
    $user_staff = App\Models\User::where("staff_url", $url)->first();
    if($user_staff) {
        $id = $user_staff->id;
        $renderParams = ["title" => config("staff.aikopanel-id-" . $id . ".app_name", "AikoPanel"), "description" => config("staff.aikopanel-id-" . $id . ".app_description", "AikoPanel of AikoCute!"), "logo" => config("staff.aikopanel-id-" . $id . ".logo"), "background_url" => config("staff.aikopanel-id-" . $id . ".background_url"), "custom_html" => config("staff.aikopanel-id-" . $id . ".custom_html"), "theme" => config("aikopanel.frontend_theme", "aikopanel"), "version" => config("app.version")];
    } else {
        $renderParams = ["title" => config("aikopanel.app_name", "AikoPanel"), "description" => config("aikopanel.app_description", "AikoPanel of AikoCute!"), "logo" => config("aikopanel.logo"), "background_url" => config("aikopanel.background_url"), "custom_html" => config("aikopanel.custom_html"), "theme" => config("aikopanel.frontend_theme", "aikopanel"), "version" => config("app.version")];
    }
    if(!config("theme." . $renderParams["theme"])) {
        $themeService = new App\Services\ThemeService($renderParams["theme"]);
        $themeService->init();
    }
    $renderParams["theme_config"] = config("theme." . config("aikopanel.frontend_theme", "aikopanel"));
    return view("theme::" . config("aikopanel.frontend_theme", "aikopanel") . ".dashboard", $renderParams);
});
Route::get("/" . config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel")), function () {
    return view("staff", ["title" => config("aikopanel.app_name", "AikoPanel"), "theme_sidebar" => config("aikopanel.frontend_theme_sidebar", "light"), "theme_header" => config("aikopanel.frontend_theme_header", "dark"), "theme_color" => config("aikopanel.frontend_theme_color", "default"), "background_url" => config("aikopanel.frontend_background_url"), "version" => config("app.version"), "logo" => config("aikopanel.logo"), "staff_path" => config("aikopanel.staff_path", config("aikopanel.frontend_staff_path", "staffaikopanel"))]);
})->middleware("license");
Route::get("/" . config("aikopanel.secure_path", config("aikopanel.frontend_admin_path", "aikopanel")), function () {
    return view("admin", ["title" => config("aikopanel.app_name", "AikoPanel"), "theme_sidebar" => config("aikopanel.frontend_theme_sidebar", "light"), "theme_header" => config("aikopanel.frontend_theme_header", "dark"), "theme_color" => config("aikopanel.frontend_theme_color", "default"), "background_url" => config("aikopanel.frontend_background_url"), "version" => config("app.version"), "logo" => config("aikopanel.logo"), "secure_path" => config("aikopanel.secure_path", config("aikopanel.frontend_admin_path", "aikopanel"))]);
});

?>