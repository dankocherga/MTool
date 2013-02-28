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
 * @package   Module
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Core;

/**
 * Module
 *
 * @category Core
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class Module
{
    /**
     * Company 
     * 
     * @var string
     */
    private $_company;

    /**
     * Name 
     * 
     * @var string
     */
    private $_name;

    /**
     * Init the module
     * 
     * @param string $company Company name
     * @param string $name    Module name
     *
     * @return void
     */
    public function init($company, $name)
    {
        $this->_company = $company;
        $this->_name = $name;
    }

    /**
     * Get company name 
     * 
     * @return string
     */
    public function getCompany()
    {
        return ucfirst($this->_company);
    }

    /**
     * Get module name 
     * 
     * @return string
     */
    public function getName()
    {
        return ucfirst($this->_name);
    }
}
