<?php
/**
 * Mage Tool
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Module provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Module extends Mtool_Providers_Abstract
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-module';
    }

    /**
     * Create module
     * @param string $name in format of companyname/modulename
     */
    public function create($name = null)
    {
        if ($name == null || false === strpos($name, '/')) {
            $companyName = $this->_ask('Enter the company name');
            $moduleName = $this->_ask('Enter the module name');
        }
        else list($companyName, $moduleName) = explode('/', $name);

        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
        $module->createDummy();

        $this->_answer('Done');
    }

    /**
     * Create module installer
     * 
     * @param string $name in format of companyname/modulename
     * @param string $version - initial module version in format of 1.5.7 
     */
    public function install($name = null, $version = null)
    {
        if ($name == null) $name = $this->_ask('Enter the target module (like mycompany/mymodule)');
        if ($version == null) $version = $this->_ask('Enter the initial module version (like 1.0.0)');
        list($companyName, $moduleName) = explode('/', $name);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());

        $module->install($version);
        $this->_answer('Done');
    }

    public function upgrade($name = null, $mode = null, $version = null)
    {
        if ($name == null) $name = $this->_ask('Enter the target module (like mycompany/mymodule)');
        if ($mode == null)
                $mode = $this->_ask('How to upgrade - to exact version or increment existing? (enter "' .
                            Mtool_Codegen_Entity_Module::UPGRADE_MODE_EXACT . '" or "' .
                            Mtool_Codegen_Entity_Module::UPGRADE_MODE_INCREMENT . '")');
        if ($version == null)
                switch ($mode) {
                case Mtool_Codegen_Entity_Module::UPGRADE_MODE_EXACT:
                    $version = $this->_ask('Enter the module version (like 1.0.0)');
                    break;
                case Mtool_Codegen_Entity_Module::UPGRADE_MODE_INCREMENT:
                    $version = $this->_ask('Enter the increment mask (like *.*.1 , * means same value as now)');
                    break;
            }

        list($companyName, $moduleName) = explode('/', $name);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());

        $module->upgrade($mode, $version);
        $this->_answer('Done');
    }

}
