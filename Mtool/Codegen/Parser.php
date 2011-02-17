<?php 
/**
 * Mage Tool
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Template parser class
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Codegen_Parser
{
    /**
     * Template params
     * @var array
     */
    protected $_params = array();

    /**
     * Set template params
     * @param array $params
     * @return Mtool_Codegen_Template
     */
    public function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    /**
     * Parse content and inject parmeters
     * parameter keys are encolured in the #{} mask
     *
     * @param string $content
     * @access public
     * @return string
     */
    public function parse($content)
    {
        $pattern = '/(#\{(.*?)\})/';
        return preg_replace_callback($pattern, array($this, 'parseVar'), $content);
    }

    /**
     * Parse one var
     *
     * @param array $matches
     * @return string
     */
    protected function parseVar($matches)
    {
        return @$this->_params[@$matches[2]];
    }
}
