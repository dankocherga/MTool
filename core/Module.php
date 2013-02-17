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
     * Set company name
     * 
     * @param string $company Name
     *
     * @return void
     */
    public function setCompany($company)
    {
        $this->_company = $company;
    }

    /**
     * Get company name 
     * 
     * @return string
     */
    public function getCompany()
    {
        return $this->_company;
    }
    
    /**
     * Set module name 
     * 
     * @param string $name Name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Get module name 
     * 
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
}
