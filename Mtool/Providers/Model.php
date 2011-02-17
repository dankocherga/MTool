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
 * Model provider
 *
 * @category   Mtool
 * @package    Mtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Providers_Model extends Mtool_Providers_Entity
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-model';
    }

    /**
     * Create model
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $modelPath in format of mymodule/model_path
     */
    public function create($targetModule = null, $modelPath = null)
    {
        $this->_createEntity(new Mtool_Codegen_Entity_Model(), 'model', $targetModule, $modelPath);
    }

    /**
     * Create new model with module auto-guessing
     * @param string $modelPath in format of mymodule/model_path
     */
    public function add($modelPath = null)
    {
        $this->_createEntityWithAutoguess(new Mtool_Codegen_Entity_Model(), 'model', $modelPath);
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
        $this->_rewriteEntity(new Mtool_Codegen_Entity_Model(), 'model', $targetModule, $originModel, $yourModel);
    }
}
