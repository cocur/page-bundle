<?php

/**
 * This file is part of CocurBlogBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Cocur\Bundle\BlogBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

use Cocur\Bundle\BlogBundle\Renderer\RoutesRenderer;

/**
 * DropboxAuthCommand
 *
 * @package    cocur/blog-bundle
 * @subpackage Command
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://cocur.florian.ec Cocur Website
 */
class DropboxAuthCommand extends Command
{
    /** @var \Dropbox_OAuth */
    private $oAuth;

    /** @var string */
    private $kernelRootDir;

    /**
     */
    public function __construct(\Dropbox_OAuth $oAuth, $kernelRootDir)
    {
        $this->oAuth = $oAuth;
        $this->kernelRootDir = $kernelRootDir;
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('cocur:dropbox-auth')
            ->setDescription('Authenticate with Dropbox.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialog();

        // First, let's reset the token and token secret
        $this->oAuth->setToken(null, null);
        $this->oAuth->getRequestToken();

        $output->writeln('Open this URL in your browser and authorize Cocur to access your Dropbox account.');
        $output->writeln(sprintf("<comment>%s</comment>\n", $this->oAuth->getAuthorizeUrl()));

        $dialog->askConfirmation($output, '<question>Done?</question> ', true);

        $token = $this->oAuth->getAccessToken();

        $output->writeln('');
        $output->writeln('The token and token secret will now be written into <comment>parameters.yml</comment>.');
        $output->writeln('If something should go wrong, you can also do it manually.');
        $output->writeln(
            sprintf("\n    dropbox_token: %s\n    dropbox_token_secret: %s", $token['token'], $token['token_secret'])
        );

        $this->putParameters($this->insertToken($this->getParameters(), $token));

    }

    /**
     * @return Symfony\Component\Console\Helper\DialogHelper
     */
    protected function getDialog()
    {
        return $this->getHelperSet()->get('dialog');
    }

    /**
     * @return array
     */
    protected function getParameters()
    {
        return Yaml::parse(file_get_contents(sprintf('%s/config/parameters.yml', $this->kernelRootDir)));
    }

    /**
     * @param array $parameters
     *
     * @return void
     */
    protected function putParameters($parameters)
    {
        file_put_contents(
            sprintf('%s/config/parameters.yml', $this->kernelRootDir),
            Yaml::dump($parameters)
        );
    }

    /**
     * @param string   $parameters
     * @param string[] $token
     *
     * @return string
     */
    protected function insertToken($parameters, array $token)
    {
        $parameters['parameters']['dropbox_token'] = $token['token'];
        $parameters['parameters']['dropbox_token_secret'] = $token['token_secret'];

        return $parameters;
    }
}
