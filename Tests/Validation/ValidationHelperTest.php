<?php

namespace Sharkzt\HelpersBundle\Tests\Validation;

use PHPUnit\Framework\TestCase;
use Sharkzt\HelpersBundle\Error\ErrorHelper;
use Sharkzt\HelpersBundle\Validation\ValidationHelper;
use Symfony\Component\Validator\Constraints\Type;

/**
 * Class ValidationHelperTest
 * @package Sharkzt\HelpersBundle\Tests\Validation
 */
class ValidationHelperTest extends TestCase
{
    /**
     * @var null
     */
    public $errorHelper;
    /**
     * @var null
     */
    public $type;

    /**
     *
     */
    public function setUp()
    {
        $this->errorHelper = null;
        $this->type = null;
    }

    /**
     * @return void
     */
    public function testClassConstructorErrorHelperParam_WithErrorHelper_ReturnObject()
    {
        $this->errorHelper = $this->getMockBuilder(ErrorHelper::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->assertAttributeEquals(
            $this->errorHelper,
            'apiErrorHelper',
            new ValidationHelper($this->errorHelper)
        );
    }

    /**
     * @param string $paramType
     * @param Type $type
     *
     * @dataProvider getTypesProvider
     */
    public function testClassConstructorTypeParams_WithTypes_ReturnObject(string $paramType, Type $type)
    {
        $validationHelper = $this->getMockBuilder(ValidationHelper::class)
            ->disableOriginalConstructor()
            ->getMock();
        $validationHelper->$paramType = $type;
        $this->assertAttributeEquals(
            $type,
            $paramType,
            $validationHelper
        );
    }

    /**
     * @return array
     */
    public static function getTypesProvider():array
    {
        return [
            [ 'numeric', new Type('numeric') ],
            [ 'integer', new Type('integer') ],
            [ 'float', new Type('float') ],
            [ 'string', new Type('string') ],
            [ 'bool', new Type('bool') ],
            [ 'double', new Type('double') ],
            [ 'scalar', new Type('scalar') ]
        ];
    }

    /**
     * @return void
     */
    public function testValidate_WithInteger_ReturnTrue()
    {
        $this->errorHelper = $this->getMockBuilder(ErrorHelper::class)
            ->disableOriginalConstructor()
            ->getMock();
        $validator = new ValidationHelper($this->errorHelper);
        $validator->setParameter([(integer)123, new Type('integer')]);
        $this->assertTrue(
            $validator->validate()
        );
    }

    /**
     * @return void
     */
    public function testValidate_WithString_ReturnFalse()
    {
        $this->errorHelper = $this->getMockBuilder(ErrorHelper::class)
            ->disableOriginalConstructor()
            ->getMock();
        $validator = new ValidationHelper($this->errorHelper);
        $validator->setParameter([(string)'12345', new Type('integer')]);
        $this->assertFalse(
            $validator->validate()
        );
    }

    /**
     * @return void
     */
    public function testGetResponse_WithString_ReturnErrArray()
    {
        $validator = new ValidationHelper(new ErrorHelper());
        $validator->setParameter([(string)'12345', new Type('integer')]);
        $validator->validate();
        $this->assertEquals(
            $validator->getResponse(), [
                "error" => [
                    "code" => 'BadParameter',
                    "message" => "Not valid parameters",
                    "target" => "Parameters",
                    "type" => [
                        [
                            0 => '12345',
                            1 => 'This value should be of type integer.'
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * @return void
     */
    public function testGetResponse_WithString_ReturnErrorArray()
    {
        $validator = new ValidationHelper(new ErrorHelper());
        $validator->setParameter([(string)'12345', new Type('integer')]);
        $validator->validate();
        $this->assertEquals(
            $validator->getResponse('foo'), [
                "error" => [
                    "code" => 'BadParameter',
                    "message" => "Not valid parameters",
                    "target" => "Parameters",
                    "type" => [
                        [
                            0 => '12345',
                            1 => 'This value should be of type integer.'
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * @return void
     */
    public function testGetResponse_WithInteger_ReturnEmptyArray()
    {
        $this->errorHelper = $this->createMock(ErrorHelper::class);
        $this->errorHelper->expects($this->any())->method('generateAPIErrorResponse')->will($this->returnValue([]));
        $validator = new ValidationHelper($this->errorHelper);
        $validator->setParameter([(integer)123, new Type('integer')]);
        $validator->validate();
        $this->assertEquals(
            $validator->getResponse(), [
            ]
        );
    }
}