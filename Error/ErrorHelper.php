<?php

namespace Sharkzt\HelpersBundle\Error;

/**
 * Class ErrorHelper
 * @package Sharkzt\HelpersBundle\Components\Error
 */
class ErrorHelper
{
    /**
     * Generate error response according to https://github.com/Microsoft/api-guidelines/blob/master/Guidelines.md
     *
     * @param string $code
     * @param string $message
     * @param string $target
     * @param string $type
     * @return array
     */
    public static function generateAPIErrorResponse(string $code = "BadParameter", string $message = "Something went wrong",
                                                 $target = 'Parameters', $type = "Something went wrong"):array
    {
        return [
            "error" => [
                "code" => $code,
                "message" => $message,
                "target" => $target,
                "type" => $type
            ]
        ];
    }
}