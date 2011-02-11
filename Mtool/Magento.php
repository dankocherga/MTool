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
     * Mtool directory
     *
     * @var string
     */
    static $mtoolDir;

    /**
     * User's home directoruy
     *
     * @var string
     */
    static $homeDir;

	/**
	 * Configure path to magento
	 * 
	 * @param string $path - absolute path tp magento root
	 */
	public function __construct($root)
	{
		$this->_root = Mtool_Codegen_Filesystem::slash($root);
        self::$mtoolDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Mtool';
        self::$homeDir = posix_getpwuid(getmyuid());
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
	 * @param string|null $where
	 * @return RegexIterator
	 */
	public function findInCode($search, $where = null)
	{
		if($where === null)
			$where = $this->_root . 'app' . DIRECTORY_SEPARATOR . 'code';
		return Mtool_Codegen_Browser::find($search, $where);
	}
}
