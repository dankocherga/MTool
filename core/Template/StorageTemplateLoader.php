<?php
/**
 * Magento code generator
 *
 * PHP version 5.3
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category  Core
 * @package   Template
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Core\Template;
use MTool\Core\Storage\IStorage;

/**
 * Storage template loader
 *
 * @category Core
 * @package  Template
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class StorageTemplateLoader implements ITemplateLoader
{
    /**
     * Storage 
     * 
     * @var IStorage
     */
    private $_storage;

    /**
     * Base dir 
     * 
     * @var string
     */
    private $_baseDir;

    /**
     * Construct 
     * 
     * @param IStorage $storage Storage
     * @param string   $baseDir Base dir
     *
     * @return void
     */
    public function __construct(IStorage $storage, $baseDir)
    {
        $this->_storage = $storage;
        $this->_baseDir = $baseDir;
    }

    /**
     * Load 
     * 
     * @param string $templateName Template name
     *
     * @return string
     */
    public function load($templateName)
    {
        return $this->_storage->read("{$this->_baseDir}/{$templateName}.tpl");
    }
}
