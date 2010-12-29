<?php 
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
		return 'mage-module';
	}

	/**
	 * Create module
	 * @param string $name in format of companyname/modulename
	 */
	public function create($name = null)
	{
		if($name == null)
		{
			$companyName = $this->_ask('Enter the company name');
			$moduleName = $this->_ask('Enter the module name');
		}
		else
			list($companyName, $moduleName) = explode('/', $name);

		$module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName);
		$module->createDummy();

		$this->_answer('Done');
	}
}
