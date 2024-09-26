<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Exceptions;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{
    protected $dontReport = [];
    protected $dontFlash = ["password", "password_confirmation"];
    public function report(\Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, \Throwable $exception)
    {
        if($exception instanceof \Facade\Ignition\Exceptions\ViewException) {
            abort(500, "Kết xuất chủ đề thất bại. Nếu chủ đề được cập nhật, các tham số có thể thay đổi, vui lòng cấu hình lại chủ đề trước khi thử.");
        }
        return parent::render($request, $exception);
    }
    protected function convertExceptionToArray(\Throwable $e)
    {
        return config("app.debug") ? ["message" => $e->getMessage(), "exception" => get_class($e), "file" => $e->getFile(), "line" => $e->getLine(), "trace" => collect($e->getTrace())->map(function ($trace) {
            return \Illuminate\Support\Arr::except($trace, ["args"]);
        })->all()] : ["message" => $this->isHttpException($e) ? $e->getMessage() : __("Uh-oh, we've had some problems, we're working on it.")];
    }
}

?>