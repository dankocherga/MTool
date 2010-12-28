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
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $blockPath in format of mymodule/block_path
	 */
	public function create($targetModule = null, $blockPath = null)
	{
		$this->_createEntity(new Mtool_Codegen_Entity_Block(), 'block', $targetModule, $blockPath);
	}

	/**
	 * Rewrite block
	 *
	 * @param string $targetModule in format of companyname/modulename
	 * @param string $originBlock in format of catalog/product
	 * @param string $yourBlock in format of catalog_product
	 */
	public function rewrite($targetModule = null, $originBlock = null, $yourBlock = null)
	{
		$this->_rewriteEntity(new Mtool_Codegen_Entity_Block(), 'block', $targetModule, $originBlock, $yourBlock);
	}
}
