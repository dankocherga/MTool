<?php 
require_once 'Mtool/Providers/Abstract.php';
require_once 'Mtool/Codegen/Entity/Module.php';
/**
 * Module provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Module extends Mtool_Providers_Abstract 
{
	/**
	 * Get provider name
	 * @return string
	 */
	public function getName()
	{
		return 'mage_module';
	}

	/**
	 * Create module
	 */
	public function create()
	{
		$companyName = $this->_ask('Enter the company name');
		$moduleName = $this->_ask('Enter the module name');

		$module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName);
		$module->createDummy();

		$this->_answer('Done');
	}
}
