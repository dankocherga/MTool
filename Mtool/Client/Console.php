<?php
/**
 * Mtool
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mtool
 * @package    Mtool_Client
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Short description of Console goes here
 *
 * @category   Mtool
 * @package    Mtool_Client
 * @subpackage Console
 * @author     Valentin Sushkov <vsushkov@oggettoweb.com>
 */
class Mtool_Client_Console extends Zend_Tool_Framework_Client_Console
{
	/**
	 * Ask user about something and read the answer using the CLI
	 *
	 * @param string $question
	 * @return string user's answer
	 */
	public function ask($question)
	{
		$response = $this->promptInteractiveInput($question);
        return $response->getContent();
	}

	/**
	 * Output text to the CL
     * 
	 * @param string $text
	 */
	public function answer($text)
	{
		$this->appendContent($text);
	}
}