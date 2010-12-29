<?php 
/**
 * Model provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Model extends Mtool_Providers_Entity
{
	/**
	 * Get provider name
	 * @return string
	 */
	public function getName()
	{
		return 'mage-model';
	}

	/**
	 * Create model
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $modelPath in format of mymodule/model_path
	 */
	public function create($targetModule = null, $modelPath = null)
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Model(), 'model', $targetModule, $modelPath);
	}

	/**
	 * Rewrite model
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $originModel in format of catalog/product
	 * @param string $yourModel in format of catalog_product
	 */
	public function rewrite($targetModule = null, $originModel = null, $yourModel = null)
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Model(), 'model', $targetModule, $originModel, $yourModel);
	}
}
