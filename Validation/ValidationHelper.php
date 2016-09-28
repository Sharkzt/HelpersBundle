<?php

namespace Sharkzt\HelpersBundle\Validation;

use Sharkzt\HelpersBundle\Error\ErrorHelper;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

/**
 * Class ValidationHelper
 * @package Sharkzt\HelpersBundle\Components\Validation
 */
class ValidationHelper
{
    /**
     * @var ErrorHelper
     */
    private $apiErrorHelper;
    /**
     * @var Type
     */
    public $numeric;
    /**
     * @var Type
     */
    public $integer;
    /**
     * @var Type
     */
    public $float;
    /**
     * @var Type
     */
    public $string;
    /**
     * @var Type
     */
    public $bool;
    /**
     * @var Type
     */
    public $double;
    /**
     * @var Type
     */
    public $scalar;
    /**
     * @var array
     */
    private $errors;
    /**
     * @var array
     */
    private $errorsArray;

    /**
     * ValidationHelper constructor.
     * @param ErrorHelper $apiErrorHelper
     */
    public function __construct(ErrorHelper $apiErrorHelper)
    {
        $this->validator = Validation::createValidator();
        $this->apiErrorHelper = $apiErrorHelper;
        $this->numeric = new Type('numeric');
        $this->integer = new Type('integer');
        $this->float = new Type('float');
        $this->string = new Type('string');
        $this->bool = new Type('bool');
        $this->double = new Type('double');
        $this->scalar = new Type('scalar');
        $this->errors = [];
        $this->errorsArray = [];
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameter(array $parameters)
    {
            array_push($this->errors, $this->validator->validate($parameters[0], $parameters[1]));
            return $this;
    }

    /**
     * @return bool
     */
    public function validate():bool
    {
        foreach ($this->errors as $error) {
            if (isset($error[0]) && $error[0]->getMessage()) {
                array_push($this->errorsArray, [$error[0]->getInvalidValue(), $error[0]->getMessage()]);
            }
        }

        if (count($this->errorsArray) > 0) {
            return false;
        }
        return true;
    }

    /**
     * @param string $type
     * @return array
     */
    public function getResponse(string $type = 'api'):array
    {
        if (count($this->errorsArray) > 0) {
            switch ($type):
                case 'api':
                    return $this->apiErrorHelper->generateAPIErrorResponse("BadParameter", "Not valid parameters", "Parameters", $this->errorsArray);
                    break;
                default:
                    return $this->apiErrorHelper->generateAPIErrorResponse("BadParameter", "Not valid parameters", "Parameters", $this->errorsArray);
                    break;
            endswitch;
        }
        return [];
    }
}