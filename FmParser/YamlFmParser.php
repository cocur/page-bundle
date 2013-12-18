<?php

/**
 * This file is part of CocurPageBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\PageBundle\FmParser;

use Symfony\Component\Yaml\Yaml;

/**
 * YamlFmParser
 *
 * @package    cocur/page-bundle
 * @subpackage FmParser
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class YamlFmParser implements FmParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($input)
    {
        return Yaml::parse($input);
    }

    /**
     * {@inheritDoc}
     */
    public function getFormat()
    {
        return 'yaml';
    }
}
