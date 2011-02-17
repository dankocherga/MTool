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
 * Mage entity provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Entity extends Mtool_Providers_Abstract
{
    /**
     * Create entity
     *
     * @param Mtool_Codegen_Entity_Abstract $entity
     * @param string $name
     * @param string $targetModule in format of companyname/modulename
     * @param string $entityPath in format of mymodule/model_path
     */
    protected function _createEntity($entity, $name, $targetModule = null, $entityPath = null)
    {
        if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
        if ($entityPath == null) {
            $entityPath = $this->_ask("Enter the {$name} path (in format of mymodule/{$name}_path)");
        }

        list($companyName, $moduleName) = explode('/', $targetModule);

        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());

        list($namespace, $entityName) = explode('/', $entityPath);

        $entity->create($namespace, $entityName, $module);

        $this->_answer('Done');
    }

    /**
     * Create entity with target module autoguessing
     *
     * @param Mtool_Codegen_Entity_Abstract $entity
     * @param string $name
     * @param string $entityPath in format of mymodule/model_path
     */
    protected function _createEntityWithAutoguess($entity, $name, $entityPath = null)
    {
        if ($entityPath == null) {
            $entityPath = $this->_ask("Enter the {$name} path (in format of mymodule/{$name}_path)");
        }
        list($namespace, $entityName) = explode('/', $entityPath);

        $module = Mtool_Codegen_Entity_Module_Finder::byNamespace(getcwd(), $entity, $namespace, $this->_getConfig());
        if ($module == null) {
            $targetModule = $this->_ask("Unfortunately module with {$name} namespace '{$namespace}' was not found. Enter the target module (in format of Mycompany/Mymodule)");
            list($companyName, $moduleName) = explode('/', $targetModule);
            $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
        }

        $entity->create($namespace, $entityName, $module);
        $this->_answer("New {$name} created under {$module->getName()} module");
    }

    /**
     * Rewrite entity
     *
     * @param Mtool_Codegen_Entity_Abstract $entity
     * @param string $name
     */
    protected function _rewriteEntity($entity, $name, $targetModule = null, $originEntityPath = null, $entityName = null)
    {
        if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
        if ($originEntityPath == null) {
            $originEntityPath = $this->_ask("Enter the magento {$name} path (for example catalog/product_type_simple)");
        }
        if ($entityName == null) {
            $entityName = $this->_ask("Enter your {$name} path (without namespace, in format of {$name}_path)");
        }

        list($companyName, $moduleName) = explode('/', $targetModule);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());

        list($originNamespace, $originEntityName) = explode('/', $originEntityPath);

        $entity->rewrite($originNamespace, $originEntityName, $entityName, $module);

        $this->_answer('Done');
    }

}
