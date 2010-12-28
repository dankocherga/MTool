<?php 
require_once 'Mtool/Codegen/Entity/Helper.php';
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
		return 'mage_helper';
	}

	/**
	 * Create helper
	 */
	public function create()
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Helper(), 'helper');
	}

	/**
	 * Rewrite helper
	 */
	public function rewrite()
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Helper(), 'helper');
	}
}
