<?php 
/**
 * Module finder
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Entity_Module_Finder
{
	/**
	 * Find module by entity namespace
	 * 
	 * @param string $root - path to the working directory
	 * @param Mtool_Codegen_Entity_Abstract $entity
	 * @param string $namespace - namespace name
     * @param array $templateConfig
	 * @return Mtool_Codegen_Entity_Module | null
	 */
	public static function byNamespace($root, $entity, $namespace, array $templateConfig)
	{
		$configNamespace = $entity->getConfigNamespace();
		$mage = new Mtool_Magento($root);

		// Find all local config.xml files
		$configs = $mage->findInCode('config.xml', $mage->getCodepoolPath());
		try
		{
			// Find entity definition through local modules
			$classPrefix = $entity->lookupOriginEntityClass($namespace, $configs);

			// Extract module and company names from class prefix
			list($companyName, $moduleName) = explode('_', $classPrefix);
			return new Mtool_Codegen_Entity_Module($root, $moduleName, $companyName, $templateConfig);
		}
		catch(Mtool_Codegen_Exception_Entity $e)
		{
			return null;
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}
}
