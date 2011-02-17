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
 * Resource model provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Rmodel extends Mtool_Providers_Entity
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-rmodel';
    }

    /**
     * Rewrite model
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $originModel in format of catalog/product
     * @param string $yourModel in format of catalog_product
     */
    public function rewrite($targetModule = null, $originModel = null, $yourModel = null)
    {
        $this->_rewriteEntity(new Mtool_Codegen_Entity_Rmodel(), 'resource model', $targetModule, $originModel,
                              $yourModel);
    }

}
