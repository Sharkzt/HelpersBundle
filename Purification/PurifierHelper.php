<?php

namespace Sharkzt\HelpersBundle\Purification;

use HTMLPurifier_Config;
use HTMLPurifier;

/**
 * Class PurifierHelper
 * @package Sharkzt\HelpersBundle\Purification
 */
class PurifierHelper
{
    /**
     * @param string $encoding
     * @param string $docType
     * @param string $html
     * @return HTMLPurifier
     */
    public static function initialize(string $encoding = 'utf-8', string $docType = 'XHTML 1.0 Strict', string $html = '')
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', $encoding);
        $config->set('HTML.Doctype', $docType);
        $config->set('HTML.Allowed', $html);
        return new HTMLPurifier($config);
    }
}