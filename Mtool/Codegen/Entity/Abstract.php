<?php 
/**
 * Abstract code generator
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
abstract class Mtool_Codegen_Entity_Abstract
{
	/**
	 * Entity folder name
	 * @var string
	 */
	protected $_folderName;

	/**
	 * Create template name
	 * @var string
	 */
	protected $_createTemplate;

	/**
	 * Rewrite template name
	 * @var string
	 */
	protected $_rewriteTemplate;

	/**
	 * Entity name
	 * @var string
	 */
	protected $_entityName;

	/**
	 * Namespace in config file
	 * @var string
	 */
	protected $_configNamespace;

	/**
	 * Create new entity
	 * 
	 * @param string $namespace 
	 * @param string $path 
	 * @param Mtool_Codegen_Entity_Module $module
	 */
	public function create($namespace, $path, Mtool_Codegen_Entity_Module $module)
	{
		// Create class file
		$this->createClass($path, $this->_createTemplate, $module);

		// Create namespace in config
		$config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
		$config->set("global/{$this->_configNamespace}/{$namespace}/class", "{$module->getName()}_{$this->_entityName}");
	}

	/**
	 * Rewrite entity
	 * 
	 * @param string $originNamespace 
	 * @param string $originPath 
	 * @param string $path 
	 * @param Mtool_Codegen_Entity_Module $module
	 */
	public function rewrite($originNamespace, $originPath, $path, Mtool_Codegen_Entity_Module $module)
	{
		// Find origin class prefix
		$classPrefix = $this->_lookupOriginEntityClass($originNamespace, $module->findThroughModules('config.xml'));

		// Create own class
		$originPathSteps = $this->_ucPath(explode('_', $originPath));
		$originClassName = implode('_', $originPathSteps);
		$params = array(
			'original_class_name' => "{$classPrefix}_{$originClassName}"
		);
		$className = $this->createClass($path, $this->_rewriteTemplate, $module, $params);

		//Register rewrite in config
		$config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
		$config->set("global/{$this->_configNamespace}/{$originNamespace}/rewrite/{$originPath}", $className);
	}

	/**
	 * Lookup the class definition among the project
	 * modules
	 * 
	 * @param string $namespace 
	 * @param string $namespace 
	 * @param string $field 
	 * @return string (like Mage_Catalog_Model)
	 */
	protected function _lookupOriginEntityClass($namespace, $configs, $field = 'class')
	{
		foreach($configs as $_config)
		{
			try
			{
				$config = new Mtool_Codegen_Config(@$_config[0]);
				if($prefix = $config->get("global/{$this->_configNamespace}/{$namespace}/{$field}"))
					return $prefix;
			}
			catch(Exception $e)
			{}
		}

		throw new Mtool_Codegen_Exception_Entity("Module with namespace {$namespace} not found");
	}

	/**
	 * Create class file
	 * 
	 * @param string $path in format: class_path_string 
	 * @param string $template 
	 * @param Mtool_Codegen_Entity_Module $module
	 * @param array $params 
	 * @return resulting class name
	 */
	public function createClass($path, $template, $module, $params = array())
	{
		$pathSteps = $this->_ucPath(explode('_', $path));
		$className = implode('_', $pathSteps);
		$classFilename = array_pop($pathSteps) . '.php';

		// Create class dir under module
		$classDir = Mtool_Codegen_Filesystem::slash($module->getDir()) . $this->_folderName .
			DIRECTORY_SEPARATOR .
			implode(DIRECTORY_SEPARATOR, $pathSteps);
		Mtool_Codegen_Filesystem::mkdir($classDir);

		// Move class template file
		$classTemplate = new Mtool_Codegen_Template($template);
		$resultingClassName = "{$module->getName()}_{$this->_entityName}_{$className}" ;
		$defaultParams = array(
			'company_name' => $module->getCompanyName(),
			'module_name'  => $module->getModuleName(),
			'class_name'   => $resultingClassName
		);
		$classTemplate->setParams(array_merge($defaultParams, $params));
		$classTemplate
			->move($classDir, $classFilename);

		return $resultingClassName;
	}

	/**
	 * Uppercase path steps
	 * 
	 * @param array $steps 
	 * @return array
	 */
	protected function _ucPath($steps)
	{
		$result = array();
		foreach($steps as $_step)
			$result[] = ucfirst($_step);
		return $result;
	}
}
