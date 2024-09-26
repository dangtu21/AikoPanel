<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Http;

class Kernel extends \Illuminate\Foundation\Http\Kernel
{
    protected $middleware = ["App\\Http\\Middleware\\CORS", "App\\Http\\Middleware\\TrustProxies", "App\\Http\\Middleware\\CheckForMaintenanceMode", "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize", "App\\Http\\Middleware\\TrimStrings", "Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull"];
    protected $middlewareGroups = ["web" => [], "api" => ["App\\Http\\Middleware\\ForceJson", "App\\Http\\Middleware\\Language", "bindings"]];
    protected $routeMiddleware = ["auth" => "App\\Http\\Middleware\\Authenticate", "auth.basic" => "Illuminate\\Auth\\Middleware\\AuthenticateWithBasicAuth", "bindings" => "Illuminate\\Routing\\Middleware\\SubstituteBindings", "cache.headers" => "Illuminate\\Http\\Middleware\\SetCacheHeaders", "can" => "Illuminate\\Auth\\Middleware\\Authorize", "guest" => "App\\Http\\Middleware\\RedirectIfAuthenticated", "signed" => "Illuminate\\Routing\\Middleware\\ValidateSignature", "throttle" => "Illuminate\\Routing\\Middleware\\ThrottleRequests", "verified" => "Illuminate\\Auth\\Middleware\\EnsureEmailIsVerified", "user" => "App\\Http\\Middleware\\User", "admin" => "App\\Http\\Middleware\\Admin", "client" => "App\\Http\\Middleware\\Client", "staff" => "App\\Http\\Middleware\\Staff", "log" => "App\\Http\\Middleware\\RequestLog", "license" => "App\\Http\\Middleware\\License", "ruleblock" => "App\\Http\\Middleware\\RuleBlockMiddleware"];
    protected $middlewarePriority = ["Illuminate\\Session\\Middleware\\StartSession", "Illuminate\\View\\Middleware\\ShareErrorsFromSession", "App\\Http\\Middleware\\Authenticate", "Illuminate\\Routing\\Middleware\\ThrottleRequests", "Illuminate\\Session\\Middleware\\AuthenticateSession", "Illuminate\\Routing\\Middleware\\SubstituteBindings", "Illuminate\\Auth\\Middleware\\Authorize"];
}

?>