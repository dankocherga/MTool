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
 * @package    Mtool_Providers
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Mage tool maintainance provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Mtool extends Mtool_Providers_Abstract
{

    /**
     * Mage tool version
     * @var string
     */
    protected $_version = '1.0.0';

    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mtool';
    }

    /**
     * Check mtool working
     */
    public function info()
    {
        $this->_answer("Magento Command Line Console Tool v{$this->_version}");
    }

}
