<?php 
require_once 'Mtool/Codegen/Entity/Block.php';
/**
 * Block provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Providers_Block extends Mtool_Providers_Entity
{
	/**
	 * Get provider name
	 * @return string
	 */
	public function getName()
	{
		return 'mage_block';
	}

	/**
	 * Create block
	 */
	public function create()
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Block(), 'block');
	}

	/**
	 * Rewrite block
	 */
	public function rewrite()
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Block(), 'block');
	}
}
