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
 * @package   Client
 * @author    Daniel Kocherga <dan.kocherga@gmail.com>
 * @copyright 2013 Daniel Kocherga (dan.kocherga@gmail.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/dankocherga/MTool
 */

namespace Client\ZFConsole\Bundle\Module\Controller;
use \Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use \Client\ZFConsole\Bundle\Module\Exception;

/**
 * Module creator controller test case
 *
 * @category Tests
 * @package  Client
 * @author   Daniel Kocherga <dan@oggettoweb.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://github.com/dankocherga/MTool
 */
class CreatorControllerTest extends AbstractConsoleControllerTestCase
{
    /**
     * Creator 
     * 
     * @var \Bundle\Module\Creator
     */
    private $_creator;

    /**
     * Module 
     * 
     * @var \Core\Module
     */
    private $_module;

    /**
     * Console 
     * 
     * @var \Zend\Console\ConsoleAdapterInterface
     */
    private $_console;

    /**
     * Path validator 
     * 
     * @var \Client\ZFConsole\Bundle\Module\Model\PathValidator
     */
    private $_pathValidator;

    /**
     * Set up 
     * 
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $root = dirname(dirname(dirname(__DIR__)));
        $root = str_replace('tests/', '', $root);
        $this->setApplicationConfig(
            include "{$root}/config/application_config.php"
        );

        $this->_moduleCreator = $this->getMockBuilder('\Bundle\Module\Creator')
            ->disableOriginalConstructor(true)->getMock();
        $this->_module = $this->getMock('\Core\Module');
        $this->_console = $this->getMock('\Zend\Console\Adapter\AdapterInterface');
        $this->_pathValidator = $this->getMock('\Client\ZFConsole\Bundle\Module\Model\PathValidator');

        $this->getApplicationServiceLocator()
            ->setAllowOverride(true)
            ->setService('ModuleCreator', $this->_moduleCreator)
            ->setService('Module', $this->_module)
            ->setService('Module\PathValidator', $this->_pathValidator)
            ->setService('console', $this->_console);
    }

    /**
     * Create command creates new module 
     * 
     * @return void
     * @test
     */
    public function createCommandCreatesNewModule()
    {
        $this->_moduleCreator->expects($this->once())
            ->method('create')
            ->with($this->equalTo($this->_module));
        $this->dispatch("create module foo/bar");
    }

    /**
     * Create command writes success message
     * 
     * @return void
     * @test
     */
    public function createCommandWritesSuccessMessage()
    {
        $this->_module->expects($this->any())->method('getCompany')
            ->will($this->returnValue('Foo'));
        $this->_module->expects($this->any())->method('getName')
            ->will($this->returnValue('Bar'));
        $this->_console->expects($this->once())->method('writeLine')
            ->with($this->equalTo('Module Foo_Bar successfully created'));
        $this->dispatch("create module foo/bar");
    }

    /**
     * Create command writes error message if path validation fails
     * 
     * @return void
     * @test
     */
    public function createCommandWritesErrorMessageIfPathValidationFails()
    {
        $this->_pathValidator->expects($this->any())->method('validate')
            ->with($this->equalTo('foobar'))
            ->will($this->throwException(new Exception('Error')));

        $this->_console->expects($this->once())->method('writeLine')
            ->with($this->equalTo("Error"));
        $this->dispatch("create module foobar");
    }

    /**
     * Create command inits module with povided company and name 
     * 
     * @return void
     * @test
     */
    public function createCommandInitsModuleWithPovidedCompanyAndName()
    {
        $this->_module->expects($this->once())->method('init')
            ->with($this->equalTo('foo'), $this->equalTo('bar'));
        $this->dispatch("create module foo/bar");
    }
}
