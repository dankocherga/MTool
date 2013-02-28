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
 * @package   Storage
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Core\Storage;

/**
 * File-based filesystem
 *
 * @category Core
 * @package  Storage
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class Filesystem implements IStorage
{
    /**
     * Create directory recursive 
     * 
     * @param string $path Path
     *
     * @return void
     */
    public function mkdir($path)
    {
        if (!mkdir($this->_preparePath($path), 0755, true)) {
            throw new Exception("Cannot create directory '{$path}'");
        }
    }

    /**
     * Write data to file
     * 
     * @param string $path    Path
     * @param string $content Content
     *
     * @return void
     */
    public function write($path, $content)
    {
        file_put_contents($this->_preparePath($path), $content);
        @chmod($this->_preparePath($path), 0644);
    }

    /**
     * Read 
     * 
     * @param string $path Path
     *
     * @return string
     */
    public function read($path)
    {
        return file_get_contents($this->_preparePath($path));
    }

    /**
     * Prepare path 
     * 
     * @param string $path Path
     *
     * @return void
     */
    private function _preparePath($path)
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $path);
    }
}
