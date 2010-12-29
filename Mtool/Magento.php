<?php
/**
 * Magento configuration class
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Magento
{
	/**
	 * Magento root path with a slash on the ending
	 * 
	 * @var string
	 */
	protected $_root;

	/**
	 * Configure path to magento
	 * 
	 * @param string $path - absolute path tp magento root
	 */
	public function __construct($root)
	{
		$this->_root = Mtool_Codegen_Filesystem::slash($root);
	}

	/**
	 * Get Magento codepool path
	 * 
	 * @param string $pool (local/community)
	 * @return string
	 */
	public function getCodepoolPath($pool = 'local')
	{
		return $this->_root . 'app' . 
			DIRECTORY_SEPARATOR . 'code' . 
			DIRECTORY_SEPARATOR . $pool . 
			DIRECTORY_SEPARATOR;
	}
	
	/**
	 * Get Magento modules config path
	 * 
	 * @param string $pool (local/community)
	 * @return string
	 */
	public function getModulesConfigPath()
	{
		return $this->_root . 'app' . 
			DIRECTORY_SEPARATOR . 'etc' . 
			DIRECTORY_SEPARATOR . 'modules' . 
			DIRECTORY_SEPARATOR;
	}

	/**
	 * Find file in the code pools
	 * 
	 * @param string $search 
	 * @return RegexIterator
	 */
	public function findInCode($search)
	{
		return Mtool_Codegen_Browser::find($search, $this->_root . 'app' . DIRECTORY_SEPARATOR . 'code');
	}
}
