<?php

namespace Sharkzt\HelpersBundle\Tests\Purification;

use PHPUnit\Framework\TestCase;
use Sharkzt\HelpersBundle\Purification\PurifierHelper;

/**
 * Class PurifierHelperTest
 * @package Sharkzt\HelpersBundle\Tests\Purification
 */
class PurifierHelperTest extends TestCase
{
    /**
     * @return void
     */
    public function testInitialize_WithNoParams_ReturnObject()
    {
        $helper = new PurifierHelper();
        $purifier = $helper->initialize();
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'utf-8');
        $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
        $config->set('HTML.Allowed', '');
        $testPurifier = new \HTMLPurifier($config);
        $this->assertEquals(
            $purifier,
            $testPurifier
        );
    }

    /**
     * @return void
     */
    public function testInitialize_WithParams_ReturnObject()
    {
        $helper = new PurifierHelper();
        $purifier = $helper->initialize('utf-8', 'HTML 4.01 Strict', 'div');
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'utf-8');
        $config->set('HTML.Doctype', 'HTML 4.01 Strict');
        $config->set('HTML.Allowed', 'div');
        $testPurifier = new \HTMLPurifier($config);
        $this->assertEquals(
            $purifier,
            $testPurifier
        );
    }
}