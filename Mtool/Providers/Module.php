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

    /**
     * Create module installer
     * 
	 * @param string $name in format of companyname/modulename
     * @param string $version - initial module version in format of 1.5.7 
     */
    public function install($name = null, $version = null)
    {
        if($name == null)
			$name = $this->_ask('Enter the target module (like mycompany/mymodule)');
        if($version == null)
			$version = $this->_ask('Enter the initial module version (like 1.0.0)');
        list($companyName, $moduleName) = explode('/', $name);
		$module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName);

        $module->install($version);
        $this->_answer('Done');
    }
}
