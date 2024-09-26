<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Providers;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    protected $namespace = "App\\Http\\Controllers";
    public function boot()
    {
        if(config("aikopanel.force_https")) {
            resolve("Illuminate\\Routing\\UrlGenerator")->forceScheme("https");
        }
        parent::boot();
    }
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }
    protected function mapWebRoutes()
    {
        \Illuminate\Support\Facades\Route::middleware("web")->namespace($this->namespace)->group(base_path("routes/web.php"));
    }
    protected function mapApiRoutes()
    {
        \Illuminate\Support\Facades\Route::group(["prefix" => "/api/v1", "middleware" => "api", "namespace" => $this->namespace], function ($router) {
            $path = app_path("Http/Routes/V1");
            if(is_dir($path . "/Server")) {
                throw new \Exception("Error: 'Server' directory found in V1.");
            }
            foreach (glob($path . "/*.php") as $file) {
                $this->app->make("App\\Http\\Routes\\V1\\" . basename($file, ".php"))->map($router);
            }
        });
        \Illuminate\Support\Facades\Route::group(["prefix" => "/api/v2", "middleware" => "api", "namespace" => $this->namespace], function ($router) {
            $path = app_path("Http/Routes/V2");
            if(is_dir($path . "/Server")) {
                throw new \Exception("Error: 'Server' directory found in V2.");
            }
            foreach (glob($path . "/*.php") as $file) {
                $this->app->make("App\\Http\\Routes\\V2\\" . basename($file, ".php"))->map($router);
            }
        });
        \Illuminate\Support\Facades\Route::group(["prefix" => "/api/v3", "middleware" => "api", "namespace" => $this->namespace], function ($router) {
            $path = app_path("Http/Routes/V3");
            if(!is_dir($path)) {
                throw new \Exception("Error: 'Aiko' directory not found in V3.");
            }
            $controllerPath = app_path("Http/Controllers/V3/Aiko/AikoController.php");
            if(!file_exists($controllerPath)) {
                throw new \Exception("Error: 'AikoController' file not found in V3.");
            }
            $controllerPath = app_path("Http/Routes/V3/AikoRoute.php");
            if(!file_exists($controllerPath)) {
                throw new \Exception("Error: 'AikoRoute' file not found in V3.");
            }
            foreach (glob($path . "/*.php") as $file) {
                $this->app->make("App\\Http\\Routes\\V3\\" . basename($file, ".php"))->map($router);
            }
        });
    }
}

?>