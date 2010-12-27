<?php 
require_once 'Mtool/Codegen/Filesystem.php';
require_once 'Mtool/Codegen/Exception/Config.php';

/**
 * Config writer
 *
 * @category   Mtool
 * @package    Codegen
 * @author     Kocherga Daniel @ oggetto web
 */
class Mtool_Codegen_Config
{
	/**
	 * Xml handle
	 * @var SimpleXMLElement
	 */
	protected $_xml;

	/**
	 * Config path
	 * @var string
	 */
	protected $_path;

	/**
	 * Load config
	 * @param string $filepath 
	 */
	public function __construct($filepath)
	{
		if(!Mtool_Codegen_Filesystem::exists($filepath))
			throw new Codegen_Exception_Config("Config file does not exist: {$filepath}");

		$this->_xml = simplexml_load_file($filepath); 
		if($this->_xml === false)
			throw new Codegen_Exception_Config("Cannot load config file: {$filepath}");

		$this->_path = $filepath;
	}

	/**
	 * Set config value
	 * 
	 * @param string $path separated by slash (/)
	 * @param string $value 
	 */
	public function set($path, $value)
	{
		$segments = explode('/', $path);
		$node = $this->_xml;
		foreach($segments as $_key => $_segment)
		{
			if($_key == count($segments) - 1)
				$nodeValue = $value;
			else $nodeValue = null;

			if(!$node->$_segment->getName())
				$node->addChild($_segment, $nodeValue);
			$node = $node->$_segment;
		}

		Mtool_Codegen_Filesystem::write($this->_path, $this->_xml->asXml());
	}
}
