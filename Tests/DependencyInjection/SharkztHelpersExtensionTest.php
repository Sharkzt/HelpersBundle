<?php

namespace Sharkzt\HelpersBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Sharkzt\HelpersBundle\DependencyInjection\SharkztHelpersExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class SharkztHelpersExtensionTest
 * @package Sharkzt\HelpersBundle\Tests\DependencyInjection
 */
class SharkztHelpersExtensionTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var SharkztHelpersExtension
     */
    private $extension;

    public function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->container->setParameter('kernel.debug', false);
        $this->extension = new SharkztHelpersExtension();
    }


    /**
     * @return void
     */
    public function testLoad_WithEmpty_ReturnErrorArray()
    {
        $this->extension->load([], $this->container);
        $this->assertEquals('validator_interface', $this->container->getParameter('validator_interface'));
    }

    /**
     * @return void
     */
    public function testErrorHelperService()
    {
        $this->extension->load([], $this->container);
        $this->assertEquals('Sharkzt\HelpersBundle\Error\ErrorHelper', $this->container->getDefinition('sharkzt_helpers.error_helper')->getClass());
    }

    /**
     * @return void
     */
    public function testValidationHelperService()
    {
        $this->extension->load([], $this->container);

        $this->assertTrue($this->container->hasDefinition('sharkzt_helpers.validation_helper'));
        $this->assertEquals(new Reference('sharkzt_helpers.error_helper'), $this->container->getDefinition('sharkzt_helpers.validation_helper')->getArgument(0));
        $this->assertEquals([], $this->container->getDefinition('sharkzt_helpers.validation_helper')->getProperties());
        $this->assertEquals('Sharkzt\HelpersBundle\Validation\ValidationHelper', $this->container->getDefinition('sharkzt_helpers.validation_helper')->getClass());
    }
}