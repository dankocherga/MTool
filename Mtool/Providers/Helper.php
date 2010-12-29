<?php 
/**
 * Helper provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Helper extends Mtool_Providers_Entity
{
	/**
	 * Get provider name
	 * @return string
	 */
	public function getName()
	{
		return 'mage-helper';
	}

	/**
	 * Create helper
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $helperPath in format of mymodule/helper_path
	 */
	public function create($targetModule = null, $helperPath = null)
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Helper(), 'helper', $targetModule, $helperPath);
	}

	/**
	 * Rewrite helper
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $originHelper in format of catalog/product
	 * @param string $yourHelper in format of catalog_product
	 */
	public function rewrite($targetModule = null, $originHelper = null, $yourHelper = null)
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Helper(), 'helper', $targetModule, $originHelper, $yourHelper);
	}
}
