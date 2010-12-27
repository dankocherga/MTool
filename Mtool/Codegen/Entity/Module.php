<?php 
require_once 'Mtool/Magento.php';
require_once 'Mtool/Codegen/Template.php';
/**
 * Module code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Module
{
	/**
	 * Magento configuration class
	 * 
	 * @var Mtool_Magento
	 */
	protected $_mage;

	/**
	 * Module name
	 * @var string
	 */
	protected $_moduleName;

	/**
	 * Company name
	 * @var string
	 */
	protected $_companyName;

	/**
	 * Module dir path
	 * @var string
	 */
	protected $_moduleDir;

	/**
	 * Module configs (etc) dir path
	 * @var string
	 */
	protected $_moduleConfigsDir;

	/**
	 * Init environemnt
	 * 
	 * @param string $root absolute path to magento root
	 */
	public function __construct($root, $moduleName, $companyName)
	{
		$this->_mage = new Mtool_Magento($root);

		$this->_moduleName = ucfirst($moduleName);
		$this->_companyName = ucfirst($companyName);

		$this->_moduleDir = $this->_mage->getCodepoolPath() . 
			$this->_companyName . 
			DIRECTORY_SEPARATOR . 
			$this->_moduleName; 
		$this->_moduleConfigsDir = $this->_moduleDir . DIRECTORY_SEPARATOR . 'etc';
	}

	/**
	 * Create dummy module:
	 * 	1. create module folder under app/code/local
	 * 	2. create module config.xml file
	 * 	3. create module file under app/etc/modules
	 */
	public function createDummy()
	{
		//TODO add initialization check

		// Check that module does not already exist
		if($this->exists())
			throw new Mtool_Codegen_Exception_Filesystem(
				"Seems like this module already exists. Aborting.");

		// Create module dir
		Mtool_Codegen_Filesystem::mkdir($this->_moduleDir);

		// Create config.xml file
		$configTemplate = new Mtool_Codegen_Template('module_config_empty');
		$configTemplate->move($this->_moduleConfigsDir, 'config.xml');

		// Create module file under app/etc/modules
		$modulesTemplate = new Mtool_Codegen_Template('module_etc');
		$name = $this->getName();
		$modulesTemplate
			->setParams(array('module_name' => $name))
			->move($this->_mage->getModulesConfigPath(), "{$name}.xml");
	}

	/**
	 * Check if module exists
	 * @return boolean
	 */
	public function exists()
	{
		// Decide by existance of config.xml file
		return Mtool_Codegen_Filesystem::exists($this->_moduleConfigsDir . DIRECTORY_SEPARATOR . 'config.xml');
	}

	/**
	 * Get module dir path
	 * @return string
	 */
	public function getDir()
	{
		return $this->_moduleDir;
	}

	/**
	 * Get path to config file
	 * 
	 * @param string $file with .xml
	 * @return string
	 */
	public function getConfigPath($file)
	{
		return $this->_moduleConfigsDir . DIRECTORY_SEPARATOR . $file;
	}

	/**
	 * Get module name in format
	 * Company_Module
	 * 
	 * @return string
	 */
	public function getName()
	{
		return "{$this->_companyName}_{$this->_moduleName}"; 
	}

	/**
	 * Get company name
	 * @return string
	 */
	public function getCompanyName()
	{
		return $this->_companyName;
	}

	/**
	 * Get module name
	 * @return string
	 */
	public function getModuleName()
	{
		return $this->_moduleName;
	}
}
