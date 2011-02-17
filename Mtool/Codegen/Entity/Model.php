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
 * Model code generator
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @subpackage Entity
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class Mtool_Codegen_Entity_Model extends Mtool_Codegen_Entity_Abstract
{
    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName = 'Model';

    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate = 'model_blank';

    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate = 'model_rewrite';

    /**
     * Entity name
     * @var string
     */
    protected $_entityName = 'Model';

    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace = 'models';
}
