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
 * @category  Client
 * @package   ZFConsole
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Client\ZFConsole\Bundle\Module\Model;
use MTool\Client\ZFConsole\Bundle\Module\Exception;

/**
 * Path validator
 *
 * @category Client
 * @package  ZFConsole
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class PathValidator
{
    /**
     * Validate 
     * 
     * @param string $path Path
     *
     * @return boolean
     * @throws Exception in case of incorrect path
     */
    public function validate($path)
    {
        if (!preg_match('/^[a-z]+\/[a-z]+/i', $path)) {
            throw new Exception("Path `{$path}` is wrong, try something like `mycompany/mymodule`");
        }
        return true;
    }
}
