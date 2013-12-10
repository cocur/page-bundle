<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * CocurBlogExtension
 *
 * @package    cocur/blog-bundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 *
 * @codeCoverageIgnore
 */
class CocurBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config/services')
        );
        foreach ([ 'command', 'controller', 'dropbox' ] as $key) {
            $loader->load(sprintf('%s.xml', $key));
        }

        $container->setParameter('cocur_blog.storage.base_path', $config['storage']['base_path']);
        $container->setParameter('cocur_blog.dropbox.consumer_key', $config['dropbox']['consumer_key']);
        $container->setParameter('cocur_blog.dropbox.consumer_secret', $config['dropbox']['consumer_secret']);

        if (true === isset($config['dropbox']['token']) && true === isset($config['dropbox']['token_secret'])) {
            $this->setDropboxOAuthToken($config, $container);
        }
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function setDropboxOAuthToken(array $config, ContainerBuilder $container)
    {
        $dropboxOAuth = $container->getDefinition('cocur_blog.dropbox.oauth');
         $dropboxOAuth->addMethodCall(
            'setToken',
            [ $config['dropbox']['token'], $config['dropbox']['token_secret'] ]
        );
    }
}
