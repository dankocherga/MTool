<?php 
require_once 'Mtool/Codegen/Entity/Model.php';
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
		return 'mage_model';
	}

	/**
	 * Create model
	 */
	public function create()
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Model(), 'model');
	}

	/**
	 * Rewrite model
	 */
	public function rewrite()
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Model(), 'model');
	}
}
