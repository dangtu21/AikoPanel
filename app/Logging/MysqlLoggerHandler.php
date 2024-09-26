<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Logging;

class MysqlLoggerHandler extends \Monolog\Handler\AbstractProcessingHandler
{
    public function __construct($level = \Monolog\Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }
    protected function write($record)
    {
        try {
            if(isset($record["context"]["exception"]) && is_object($record["context"]["exception"])) {
                $record["context"]["exception"] = (array) $record["context"]["exception"];
            }
            $record["request_data"] = request()->all() ?? [];
            $log = ["title" => $record["message"], "level" => $record["level_name"], "host" => $record["request_host"] ?? request()->getSchemeAndHttpHost(), "uri" => $record["request_uri"] ?? request()->getRequestUri(), "method" => $record["request_method"] ?? request()->getMethod(), "ip" => request()->getClientIp(), "data" => json_encode($record["request_data"]), "context" => isset($record["context"]) ? json_encode($record["context"]) : "", "created_at" => strtotime($record["datetime"]), "updated_at" => strtotime($record["datetime"])];
            \App\Models\Log::insert($log);
        } catch (\Exception $ex) {
            \Illuminate\Support\Facades\Log::channel("daily")->error($_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage() . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getFile() . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getTraceAsString());
        }
    }
}

?>