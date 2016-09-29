<?php

namespace Sharkzt\HelpersBundle\Tests\Error;

use Sharkzt\HelpersBundle\Error\ErrorHelper;

class ErrorHelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers ErrorHelper::generateAPIErrorResponse()
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
     * @covers ErrorHelper::generateAPIErrorResponse()
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