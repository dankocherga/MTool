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
 * Helper provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Helper extends Mtool_Providers_Entity
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-helper';
    }

    /**
     * Create helper
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $helperPath in format of mymodule/helper_path
     */
    public function create($targetModule = null, $helperPath = null)
    {
        $this->_createEntity(new Mtool_Codegen_Entity_Helper(), 'helper', $targetModule, $helperPath);
    }

    /**
     * Create new helper with module auto-guessing
     * @param string $helperPath in format of mymodule/helper_path
     */
    public function add($helperPath = null)
    {
        $this->_createEntityWithAutoguess(new Mtool_Codegen_Entity_Helper(), 'helper', $helperPath);
    }

    /**
     * Rewrite helper
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $originHelper in format of catalog/product
     * @param string $yourHelper in format of catalog_product
     */
    public function rewrite($targetModule = null, $originHelper = null, $yourHelper = null)
    {
        $this->_rewriteEntity(new Mtool_Codegen_Entity_Helper(), 'helper', $targetModule, $originHelper, $yourHelper);
    }
}
