<?php 
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
			throw new Mtool_Codegen_Exception_Config("Config file does not exist: {$filepath}");

		$this->_xml = simplexml_load_file($filepath); 
		if($this->_xml === false)
			throw new Mtool_Codegen_Exception_Config("Cannot load config file: {$filepath}");

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

		Mtool_Codegen_Filesystem::write($this->_path, $this->asPrettyXML());
	}

	/**
	 * Format xml with indents and line breaks
	 * 
	 * @return string
	 * @author Gary Malcolm
	 */
	public function asPrettyXML()
	{
		$string = $this->_xml->asXML();

		// put each element on it's own line
		$string =preg_replace("/>\s*</",">\n<",$string);

		// each element to own array
		$xmlArray = explode("\n",$string);

		// holds indentation
		$currIndent = 0;
		
		// set xml element first by shifting of initial element
		$string = array_shift($xmlArray) . "\n";
		foreach($xmlArray as $element) 
		{
			// find open only tags... add name to stack, and print to string
			// increment currIndent
			if (preg_match('/^<([\w])+[^>\/]*>$/U',$element)) 
			{
			   $string .=  str_repeat("\t", $currIndent) . $element . "\n";
			   $currIndent += 1;
			} // find standalone closures, decrement currindent, print to string
			elseif ( preg_match('/^<\/.+>$/',$element)) 
			{
			   $currIndent -= 1;
			   $string .=  str_repeat("\t", $currIndent) . $element . "\n";
			} // find open/closed tags on the same line print to string
			else
			   $string .=  str_repeat("\t", $currIndent) . $element . "\n";
		}
		return $string;
	}

	/**
	 * Read the config value
	 *
	 * @param string $path
	 * @return string
	 */
	public function get($path)
	{
		$node = $this->_xml;
		foreach(explode('/', $path) as $_segment)
			if($node->$_segment)
				$node = $node->$_segment;

		return (string) trim($node);
	}
}
