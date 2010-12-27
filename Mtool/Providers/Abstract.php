<?php 
/**
 * Abstract provider
 *
 * @category   Mtool
 * @package    Providers
 * @author     Kocherga Daniel @ oggetto web
 */
abstract class Mtool_Providers_Abstract
    extends Zend_Tool_Framework_Provider_Abstract
{
	/**
	 * Ask user about
	 * 
	 * @param string $question
	 * @return string
	 */
	protected function _ask($question)
	{
		$response = $this->_registry
			 ->getClient()
			 ->promptInteractiveInput($question);
        return $response->getContent();
	}

	/**
	 * Pass answer to the output
	 * @param string $text 
	 */
	protected function _answer($text)
	{
		$this->_registry->getResponse()
			->appendContent($text);
	}
}
