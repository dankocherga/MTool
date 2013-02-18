<?php
/**
 * Magento code generator
 *
 * PHP version 5.3
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category  Bundle
 * @package   Module
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Bundle\Module;

/**
 * Module creator
 *
 * @category Bundle
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class Creator
{
    /**
     * Filesystem 
     * 
     * @var \Core\IFilesystem
     */
    private $_fs;

    /**
     * Environment
     *
     * @var \Core\IEnvironment
     */
    private $_env;

    /**
     * Init the creator 
     * 
     * @param \Core\IFilesystem  $filesystem      Filesystem
     * @param \Core\IEnvironment $env             Environment
     * @param TemplateFactory    $templateFactory Template factory
     *
     * @return void
     */
    public function __construct(
        \Core\IFilesystem $filesystem,
        \Core\IEnvironment $env,
        ITemplateFactory $templateFactory
    ) {
        $this->_fs = $filesystem;
        $this->_env = $env;
        $this->_templateFactory = $templateFactory;
    }

    /**
     * Create module 
     * 
     * @param \Core\Module $module Module
     *
     * @return void
     */
    public function create(\Core\Module $module)
    {
        $configPath = "{$this->_env->getWorkingDir()}/app/code/local/" . 
                      "{$module->getCompany()}/{$module->getName()}/etc/config.xml";
        $this->_fs->mkdir(dirname($configPath));
        $this->_fs->write(
            $configPath,
            $this->_templateFactory->getModuleConfig()->parse()
        );
    }
}
