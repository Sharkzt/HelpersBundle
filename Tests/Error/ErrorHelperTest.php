<?php

namespace Sharkzt\HelpersBundle\Tests\Error;

use PHPUnit\Framework\TestCase;
use Sharkzt\HelpersBundle\Error\ErrorHelper;

/**
 * Class ErrorHelperTest
 * @package Sharkzt\HelpersBundle\Tests\Error
 */
class ErrorHelperTest extends TestCase
{

    /**
     * @return void
     */
    public function testGetApiResponse_WithEmpty_ReturnErrorArray()
    {
        $errorHelper = new ErrorHelper();
        $this->assertEquals(
            $errorHelper->generateAPIErrorResponse(), [
                "error" => [
                    "code" => 'BadParameter',
                    "message" => "Something went wrong",
                    "target" => "Parameters",
                    "type" => "Something went wrong"
                ]
            ]
        );
    }

    /**
     * @return void
     */
    public function testGetApiResponse_WithStrings_ReturnErrorArray()
    {
        $errorHelper = new ErrorHelper();
        $this->assertEquals(
            $errorHelper->generateAPIErrorResponse(), [
                "error" => [
                    "code" => 'BadParameter',
                    "message" => "Something went wrong",
                    "target" => "Parameters",
                    "type" => "Something went wrong"
                ]
            ]
        );
    }
}