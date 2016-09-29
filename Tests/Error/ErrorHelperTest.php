<?php

namespace Sharkzt\HelpersBundle\Tests\Error;

use Sharkzt\HelpersBundle\Error\ErrorHelper;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ErrorHelperTest extends KernelTestCase
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