<?php 
require_once 'Mtool/Codegen/Entity/Module.php';
require_once 'Mtool/Providers/Abstract.php';
/**
 * Mage entity provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Entity
    extends Mtool_Providers_Abstract
{
	/**
	 * Create entity
	 *
	 * @param Mtool_Codegen_Entity_Abstract $entity
	 * @param string $name
	 */
	protected function _createEntity($entity, $name)
	{
		$targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
		$entityPath = $this->_ask("Enter the {$name} path (in format of mymodule/{$name}_path)");

		list($companyName, $moduleName) = explode('/', $targetModule);
		$module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName);

		list($namespace, $entityName) = explode('/', $entityPath);

		$entity->create($namespace, $entityName, $module);

		$this->_answer('Done');
	}

	/**
	 * Rewrite entity
	 *
	 * @param Mtool_Codegen_Entity_Abstract $entity
	 * @param string $name
	 */
	protected function _rewriteEntity($entity, $name)
	{
		$targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
		$originEntityPath = $this->_ask("Enter the magento {$name} path (for example catalog/product_type_simple)");
		$entityName = $this->_ask("Enter your {$name} path (without namespace, in format of {$name}_path)");

		list($companyName, $moduleName) = explode('/', $targetModule);
		$module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName);

		list($originNamespace, $originEntityName) = explode('/', $originEntityPath);

		$entity->rewrite($originNamespace, $originEntityName, $entityName, $module);

		$this->_answer('Done');
	}
}
