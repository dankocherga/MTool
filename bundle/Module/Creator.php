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

namespace MTool\Bundle\Module;
use MTool\Core\Storage\IStorage;
use MTool\Core\Environment\IEnvironment;
use MTool\Core\Module;

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
     * Storage 
     * 
     * @var IStorage
     */
    private $_storage;

    /**
     * Environment
     *
     * @var IEnvironment
     */
    private $_env;

    /**
     * Init the creator 
     * 
     * @param IStorage        $storage         Storage
     * @param IEnvironment    $env             Environment
     * @param TemplateFactory $templateFactory Template factory
     *
     * @return void
     */
    public function __construct(
        IStorage $storage,
        IEnvironment $env,
        TemplateFactory $templateFactory
    ) {
        $this->_storage = $storage;
        $this->_env = $env;
        $this->_templateFactory = $templateFactory;
    }

    /**
     * Create module 
     * 
     * @param Module $module Module
     *
     * @return void
     */
    public function create(Module $module)
    {
        $this->_createModuleConfig($module);
        $this->_createModuleGlobalConfig($module);
    }

    /**
     * Create module global config 
     * 
     * @param Module $module Module
     *
     * @return void
     */
    private function _createModuleGlobalConfig(Module $module)
    {
        $path = "{$this->_env->getWorkingDir()}/app/etc/modules/" . 
                "{$module->getCompany()}_{$module->getName()}.xml";
        $this->_storage->write(
            $path, $this->_templateFactory->getModuleGlobalConfig($module)->parse()
        );
    }

    /**
     * Create module config 
     * 
     * @param Module $module Module
     *
     * @return void
     */
    private function _createModuleConfig(Module $module)
    {
        $path = "{$this->_env->getWorkingDir()}/app/code/local/" . 
                "{$module->getCompany()}/{$module->getName()}/etc/config.xml";
        $this->_storage->mkdir(dirname($path));
        $this->_storage->write(
            $path, $this->_templateFactory->getModuleConfig($module)->parse()
        );
    }
}
