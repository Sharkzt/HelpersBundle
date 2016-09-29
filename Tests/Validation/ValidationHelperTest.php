<?php
/**
 * Created by shark
 * Date: 9/29/16
 * Time: 11:44 AM
 */

namespace Sharkzt\HelpersBundle\Tests\Validation;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidationHelperTest extends KernelTestCase
{
    public function __construct($name = null, $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        self::bootKernel();
    }
}