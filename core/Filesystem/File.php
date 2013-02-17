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
 * @package   Filesystem
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Core\Filesystem;

/**
 * File-based filesystem
 *
 * @category Core
 * @package  Filesystem
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class File implements \Core\IFilesystem
{
    /**
     * Create directory recursive 
     * Separate directories with slash(/)
     * 
     * @param string $path Path
     *
     * @return void
     */
    public function mkdir($path)
    {
        $preparedPath = str_replace('/', DIRECTORY_SEPARATOR, $path);
        if (!mkdir($preparedPath, 0755, true)) {
            throw new Exception("Cannot create directory '{$preparedPath}'");
        }
    }
}
