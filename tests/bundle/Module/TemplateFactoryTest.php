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
 * @package   Module
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace MTool\Bundle\Module;

/**
 * Module template factory test case
 *
 * @category Tests
 * @package  Module
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class TemplateFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Module 
     * 
     * @var \MTool\Core\Module;
     */
    private $_module;

    /**
     * Loader 
     * 
     * @var \MTool\Core\Template\ITemplateLoader
     */
    private $_loader;

    /**
     * Template 
     * 
     * @var \MTool\Core\Template\ITemplate
     */
    private $_template;

    /**
     * Factory 
     * 
     * @var TemplateFactory
     */
    private $_factory;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        $this->_module = $this->getMockBuilder('\MTool\Core\Module')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_loader = $this->getMock('\MTool\Core\Template\ITemplateLoader');
        $this->_template = $this->getMock('\MTool\Core\Template\ITemplate');
        $this->_factory = new TemplateFactory($this->_template, $this->_loader);
    }

    /**
     * Get module config populates template with content 
     * 
     * @return void
     * @test
     */
    public function getModuleConfigPopulatesTemplateWithContent()
    {
        $this->_loader->expects($this->any())->method('load')
            ->with($this->equalTo('module_config'))
            ->will($this->returnValue('foo'));

        $this->_template->expects($this->once())->method('setContent')
            ->with($this->equalTo('foo'));

        $this->_factory->getModuleConfig($this->_module);
    }

    /**
     * Get module config sets params to template 
     * 
     * @return void
     * @test
     */
    public function getModuleConfigSetsParamsToTemplate()
    {
        $expectedParams = array(
            'module' => $this->_module
        );
        $this->_template->expects($this->once())->method('setParams')
            ->with($this->equalTo($expectedParams));

        $this->_factory->getModuleConfig($this->_module);
    }

    /**
     * Get module config returns template instance 
     * 
     * @return void
     * @test
     */
    public function getModuleConfigReturnsTemplateInstance()
    {
        $this->assertSame(
            $this->_template,
            $this->_factory->getModuleConfig($this->_module)
        );
    }

    /**
     * Get module global config populates template with content 
     * 
     * @return void
     * @test
     */
    public function getModuleGlobalConfigPopulatesTemplateWithContent()
    {
        $this->_loader->expects($this->any())->method('load')
            ->with($this->equalTo('module_global_config'))
            ->will($this->returnValue('foo'));

        $this->_template->expects($this->once())->method('setContent')
            ->with($this->equalTo('foo'));

        $this->_factory->getModuleGlobalConfig($this->_module);
    }

    /**
     * Get module global config sets params to template 
     * 
     * @return void
     * @test
     */
    public function getModuleGlobalConfigSetsParamsToTemplate()
    {
        $expectedParams = array(
            'module' => $this->_module
        );
        $this->_template->expects($this->once())->method('setParams')
            ->with($this->equalTo($expectedParams));

        $this->_factory->getModuleGlobalConfig($this->_module);
    }

    /**
     * Get module global config returns template instance 
     * 
     * @return void
     * @test
     */
    public function getModuleGlobalConfigReturnsTemplateInstance()
    {
        $this->assertSame(
            $this->_template,
            $this->_factory->getModuleGlobalConfig($this->_module)
        );
    }
}
