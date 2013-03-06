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
 * @category  Tests
 * @package   Core
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Core;

/**
 * Module creator test case
 *
 * @category Tests
 * @package  Core
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Module 
     * 
     * @var Module
     */
    private $_module;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        $this->_module = new Module;
    }

    /**
     * Returns company name uppercased 
     * 
     * @return void
     * @test
     */
    public function returnsCompanyNameUppercased()
    {
        $this->_module->init('myFoo', 'bar');
        $this->assertEquals('MyFoo', $this->_module->getCompany());
    }

    /**
     * Returns module name uppercased 
     * 
     * @return void
     * @test
     */
    public function returnsModuleNameUppercased()
    {
        $this->_module->init('foo', 'myBar');
        $this->assertEquals('MyBar', $this->_module->getName());
    }
}
